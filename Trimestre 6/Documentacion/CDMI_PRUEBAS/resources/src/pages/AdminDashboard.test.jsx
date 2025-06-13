import React from "react";
import { render, screen } from "@testing-library/react";
import { MemoryRouter } from "react-router-dom";
import AdminDashboard from "./AdminDashboard";

// Mock para useNavigate
const mockedNavigate = jest.fn();

// Mock del hook useNavigate
jest.mock("react-router-dom", () => ({
  ...jest.requireActual("react-router-dom"),
  useNavigate: () => mockedNavigate,
}));

describe("AdminDashboard", () => {
  beforeEach(() => {
    // Limpiar mocks y localStorage antes de cada test
    mockedNavigate.mockClear();
    localStorage.clear();
  });

  test("redirige a /login si no hay token o el rol no es administrador", () => {
    // No seteamos token ni rol en localStorage
    render(
      <MemoryRouter>
        <AdminDashboard />
      </MemoryRouter>
    );

    expect(mockedNavigate).toHaveBeenCalledWith("/login");
  });

  test("redirige a /login si el rol no es administrador", () => {
    localStorage.setItem("auth-token", "token_valido");
    localStorage.setItem("rol", "usuario"); // rol incorrecto

    render(
      <MemoryRouter>
        <AdminDashboard />
      </MemoryRouter>
    );

    expect(mockedNavigate).toHaveBeenCalledWith("/login");
  });

  test("muestra las imágenes si el usuario es administrador", () => {
    localStorage.setItem("auth-token", "token_valido");
    localStorage.setItem("rol", "administrador");

    render(
      <MemoryRouter>
        <AdminDashboard />
      </MemoryRouter>
    );

    // No se debe llamar a navigate en este caso
    expect(mockedNavigate).not.toHaveBeenCalled();

    // Comprobamos que se muestran las imágenes
    const images = screen.getAllByRole("img");
    expect(images.length).toBe(3);

    // Comprobar que los textos están visibles
    expect(screen.getByText(/Texto representativo de la comunidad indígena/i)).toBeInTheDocument();
    expect(screen.getByText(/Descripción cultural y significativa/i)).toBeInTheDocument();
    expect(screen.getByText(/Información relevante y respetuosa/i)).toBeInTheDocument();
  });
});
