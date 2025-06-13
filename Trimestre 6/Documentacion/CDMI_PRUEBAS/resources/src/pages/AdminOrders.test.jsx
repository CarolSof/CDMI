import React from 'react';
import { render, screen, waitFor } from '@testing-library/react';
import AdminOrders from './AdminOrders';
import axios from 'axios';

// Mock de axios
jest.mock('axios');

describe('AdminOrders', () => {
  beforeEach(() => {
    localStorage.setItem('auth-token', 'token_falso');
    jest.clearAllMocks();
  });

  test('muestra mensaje cuando no hay órdenes', async () => {
    // Mockeamos axios.get para que devuelva un arreglo vacío
    axios.get.mockResolvedValueOnce({ data: [] });

    render(<AdminOrders />);

    // Esperamos a que se muestre el mensaje de no órdenes
    await waitFor(() => {
      expect(screen.getByText(/No hay órdenes registradas./i)).toBeInTheDocument();
    });
  });

  test('muestra lista de órdenes cuando existen', async () => {
    const mockOrders = [
      {
        id: 1,
        user: { name: 'Juan' },
        total: 150,
        status: 'Pendiente',
        created_at: '2025-06-10T10:00:00Z',
        items: [
          { id: 101, product: { nombre: 'Producto A' }, quantity: 2, price: 50 },
          { id: 102, product: { nombre: 'Producto B' }, quantity: 1, price: 50 }
        ]
      }
    ];

    axios.get.mockResolvedValueOnce({ data: mockOrders });

    render(<AdminOrders />);

    // Esperamos a que la orden aparezca
    await waitFor(() => {
      expect(screen.getByText(/Orden #1 - Usuario: Juan/i)).toBeInTheDocument();
      expect(screen.getByText(/Total: \$150/i)).toBeInTheDocument();
      expect(screen.getByText(/Estado: Pendiente/i)).toBeInTheDocument();
      expect(screen.getByText(/Ver detalle de productos/i)).toBeInTheDocument();

      // Revisamos detalle productos
      expect(screen.getByText(/Producto A — Cantidad: 2 — Precio: \$50/i)).toBeInTheDocument();
      expect(screen.getByText(/Producto B — Cantidad: 1 — Precio: \$50/i)).toBeInTheDocument();
    });
  });

  test('muestra error en consola si la llamada falla', async () => {
  const consoleErrorSpy = jest.spyOn(console, 'error').mockImplementation(() => {});

  axios.get.mockRejectedValueOnce(new Error('Error de prueba'));

  render(<AdminOrders />);

  await waitFor(() => {
    expect(consoleErrorSpy).toHaveBeenCalledWith(
      expect.stringContaining('Error al cargar órdenes:'),
      expect.any(Error)
    );
  });

  consoleErrorSpy.mockRestore();
});

});
