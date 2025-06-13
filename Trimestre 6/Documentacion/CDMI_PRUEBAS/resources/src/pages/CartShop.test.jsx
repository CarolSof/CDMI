import React from 'react';
import { render, screen, waitFor, fireEvent } from '@testing-library/react';
import CartShop from './CartShop';
import axios from 'axios';

jest.mock('axios');

describe('CartShop', () => {
  beforeEach(() => {
    localStorage.setItem('auth-token', 'token_falso');
    jest.clearAllMocks();
  });

  test('muestra mensaje cuando el carrito está vacío', async () => {
    axios.get.mockResolvedValueOnce({ data: { items: [] } });

    render(<CartShop />);

    await waitFor(() => {
      expect(screen.getByText(/Tu carrito está vacío./i)).toBeInTheDocument();
    });
  });

  test('muestra items en el carrito y total correctamente', async () => {
    const mockItems = [
      { id: 1, product_name: 'Producto A', price: '10.00', quantity: 2 },
      { id: 2, product_name: 'Producto B', price: '5.50', quantity: 1 }
    ];

    axios.get.mockResolvedValueOnce({ data: { items: mockItems } });

    render(<CartShop />);

    // Esperamos que los productos aparezcan
    await waitFor(() => {
      expect(screen.getByText('Producto A')).toBeInTheDocument();
      expect(screen.getByText('$10.00')).toBeInTheDocument();
      expect(screen.getByText('Producto B')).toBeInTheDocument();
      expect(screen.getByText('$5.50')).toBeInTheDocument();
      expect(screen.getByText('Total: $25.50')).toBeInTheDocument(); // 10*2 + 5.5*1 = 25.5
    });
  });

  test('puede eliminar un item del carrito', async () => {
    const mockItems = [
      { id: 1, product_name: 'Producto A', price: '10.00', quantity: 2 },
    ];

    axios.get.mockResolvedValueOnce({ data: { items: mockItems } });
    axios.delete.mockResolvedValueOnce({});

    render(<CartShop />);

    // Esperamos el render inicial
    await waitFor(() => {
      expect(screen.getByText('Producto A')).toBeInTheDocument();
    });

    // Click en el botón eliminar
    fireEvent.click(screen.getByRole('button', { name: '🗑️' }));

    // Esperamos que el item desaparezca y el mensaje de carrito vacío aparezca
    await waitFor(() => {
      expect(screen.queryByText('Producto A')).not.toBeInTheDocument();
      expect(screen.getByText(/Tu carrito está vacío./i)).toBeInTheDocument();
    });
  });

  test('puede cambiar la cantidad de un item', async () => {
    const mockItems = [
      { id: 1, product_name: 'Producto A', price: '10.00', quantity: 2 },
    ];

    axios.get.mockResolvedValueOnce({ data: { items: mockItems } });
    axios.put.mockResolvedValueOnce({});

    render(<CartShop />);

    await waitFor(() => {
      expect(screen.getByText('2')).toBeInTheDocument();
    });

    // Click para aumentar cantidad
    fireEvent.click(screen.getByText('+'));

    await waitFor(() => {
      expect(screen.getByText('3')).toBeInTheDocument();
    });
  });

  test('finaliza la compra y limpia el carrito', async () => {
    window.alert = jest.fn(); // mock alert

    const mockItems = [
      { id: 1, product_name: 'Producto A', price: '10.00', quantity: 2 },
    ];

    axios.get.mockResolvedValueOnce({ data: { items: mockItems } });
    axios.post.mockResolvedValueOnce({});

    render(<CartShop />);

    await waitFor(() => {
      expect(screen.getByText('Producto A')).toBeInTheDocument();
    });

    fireEvent.click(screen.getByText(/Finalizar compra/i));

    await waitFor(() => {
      expect(window.alert).toHaveBeenCalledWith('Compra finalizada');
      expect(screen.getByText(/Tu carrito está vacío./i)).toBeInTheDocument();
    });
  });
});
