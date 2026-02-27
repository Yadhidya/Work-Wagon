import React, { useState } from 'react'
import { Link, useNavigate } from 'react-router-dom'

const WorkerLogin = () => {

  const [form, setForm] = useState({
    email: "",
    password: ""
  });

  const navigate = useNavigate();

  const handleChange = (e) => {
    setForm({
      ...form,
      [e.target.name]: e.target.value
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    const response = await fetch("http://localhost:8080/worker/login", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      credentials: "include",
      body: JSON.stringify(form)
    });

    if (response.ok) {
      const data = await response.json();
      localStorage.setItem("worker", JSON.stringify(data));
      navigate("/");
    } else {
      alert("Invalid credentials");
    }
  };

  return (
    <div className="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-100 via-white to-purple-100 px-4">
      <div className="w-full max-w-md bg-white rounded-3xl shadow-xl p-10">

        <h2 className="text-3xl font-bold text-center text-gray-800 mb-8">
          Worker Login
        </h2>

        <form className="flex flex-col gap-5" onSubmit={handleSubmit}>
          
          <div className="flex flex-col">
            <label className="text-sm font-medium text-gray-600 mb-1">
              Email
            </label>
            <input 
              type="email"
              name="email"
              onChange={handleChange}
              required
              className="px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
            />
          </div>

          <div className="flex flex-col">
            <label className="text-sm font-medium text-gray-600 mb-1">
              Password
            </label>
            <input 
              type="password"
              name="password"
              onChange={handleChange}
              required
              className="px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
            />
          </div>

          <button 
            type="submit"
            className="mt-4 bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-3 rounded-xl transition duration-300"
          >
            Login
          </button>

        </form>

        <p className="text-sm text-center text-gray-500 mt-6">
          Don’t have an account?{" "}
          <Link 
            to="/worker_register" 
            className="text-indigo-600 font-medium hover:underline"
          >
            Register here
          </Link>
        </p>

      </div>
    </div>
  )
}

export default WorkerLogin