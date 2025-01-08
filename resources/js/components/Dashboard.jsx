import React from "react";

const Dashboard = () => {
  return (
    <div className="min-h-screen bg-gray-100">
      {/* Navbar */}
      <nav className="bg-blue-800 text-white py-4">
        <div className="max-w-7xl mx-auto flex justify-between items-center px-6">
          <h1 className="text-2xl font-bold">Decameron Dashboard</h1>
          <button
            onClick={() => (window.location.href = "/logout")}
            className="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded"
          >
            Cerrar Sesión
          </button>
        </div>
      </nav>

      {/* Main Content */}
      <div className="max-w-7xl mx-auto px-6 py-8">
        <h2 className="text-3xl font-bold text-blue-800 mb-6">
          Panel de Gestión
        </h2>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          {/* Hoteles */}
          <div className="bg-white shadow-lg rounded-lg p-6">
            <h3 className="text-2xl font-bold text-blue-700 mb-4">
              Gestión de Hoteles
            </h3>
            <p className="text-gray-600 mb-4">
              Administra todos los hoteles Decameron desde aquí.
            </p>
            <a
              href="/hotels"
              className="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
            >
              Ver Hoteles
            </a>
          </div>

          {/* Acomodaciones */}
          <div className="bg-white shadow-lg rounded-lg p-6">
            <h3 className="text-2xl font-bold text-blue-700 mb-4">
              Gestión de Acomodaciones
            </h3>
            <p className="text-gray-600 mb-4">
              Configura los tipos de habitaciones y acomodaciones.
            </p>
            <a
              href="/accommodations"
              className="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
            >
              Ver Acomodaciones
            </a>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Dashboard;
