import React from 'react';
import { render, screen } from '@testing-library/react';
import DonationForm from './DonationForm';
import { MemoryRouter } from 'react-router-dom';

const mockNavigate = jest.fn();

jest.mock('react-router-dom', () => ({
  ...jest.requireActual('react-router-dom'),
  useNavigate: () => mockNavigate,
}));

describe('DonationForm', () => {
  beforeEach(() => {
    jest.clearAllMocks();
    localStorage.clear();
  });

  test('redirige a /login si no hay token', () => {
    localStorage.removeItem('auth-token');
    localStorage.setItem('rol', 'usuario');

    const { container } = render(
      <MemoryRouter>
        <DonationForm />
      </MemoryRouter>
    );

    expect(mockNavigate).toHaveBeenCalledWith('/login');
    expect(container.firstChild).toBeNull(); // No renderiza nada
  });

  test('redirige a /login si el rol no es usuario', () => {
    localStorage.setItem('auth-token', 'token_valido');
    localStorage.setItem('rol', 'administrador');

    const { container } = render(
      <MemoryRouter>
        <DonationForm />
      </MemoryRouter>
    );

    expect(mockNavigate).toHaveBeenCalledWith('/login');
    expect(container.firstChild).toBeNull();
  });

  test('renderiza el formulario si el usuario está autorizado', () => {
    localStorage.setItem('auth-token', 'token_valido');
    localStorage.setItem('rol', 'usuario');

    render(
      <MemoryRouter>
        <DonationForm />
      </MemoryRouter>
    );

    expect(screen.getByText(/Formulario de Donaciones/i)).toBeInTheDocument();
    expect(screen.getByLabelText(/Nombre:/i)).toBeInTheDocument();
    expect(screen.getByLabelText(/Correo electrónico:/i)).toBeInTheDocument();
    expect(screen.getByLabelText(/Cantidad a donar:/i)).toBeInTheDocument();
    expect(screen.getByLabelText(/Moneda:/i)).toBeInTheDocument();
    expect(screen.getByLabelText(/Un mensaje para CDMI/i)).toBeInTheDocument();
  });
});
