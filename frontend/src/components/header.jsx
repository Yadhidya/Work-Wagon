import React, { useState, useRef, useEffect } from "react";
import { Link, useNavigate } from "react-router-dom";

const Header = () => {

  const [showLogin, setShowLogin] = useState(false);
  const [showRegister, setShowRegister] = useState(false);
  const [showUserMenu, setShowUserMenu] = useState(false);
  const [user, setUser] = useState(null);

  const loginRef = useRef(null);
  const registerRef = useRef(null);
  const userRef = useRef(null);
  const navigate = useNavigate();

  useEffect(() => {
    const shop = localStorage.getItem("shop");
    const worker = localStorage.getItem("worker");

    if (shop) {
      setUser({ type: "shop" });
    }

    if (worker) {
      setUser({ type: "worker" });
    }
  }, []);

  useEffect(() => {
    const handleClickOutside = (event) => {
      if (loginRef.current && !loginRef.current.contains(event.target)) {
        setShowLogin(false);
      }
      if (registerRef.current && !registerRef.current.contains(event.target)) {
        setShowRegister(false);
      }
      if (userRef.current && !userRef.current.contains(event.target)) {
        setShowUserMenu(false);
      }
    };

    document.addEventListener("mousedown", handleClickOutside);
    return () => {
      document.removeEventListener("mousedown", handleClickOutside);
    };
  }, []);

  const handleLogout = async () => {

    if (user?.type === "shop") {
      await fetch("http://localhost:8080/shop/logout", {
        method: "POST",
        credentials: "include"
      });
    }

    if (user?.type === "worker") {
      await fetch("http://localhost:8080/worker/logout", {
        method: "POST",
        credentials: "include"
      });
    }

    localStorage.removeItem("shop");
    localStorage.removeItem("worker");
    setUser(null);
    navigate("/");
  };

  return (
    <div className="h-16 w-full bg-white border-b border-gray-200 flex justify-between items-center px-8 shadow-sm relative">

      <Link to="/" className="text-2xl font-bold text-indigo-600">
        Work Wagon
      </Link>

      <div className="flex items-center gap-8 relative text-gray-700 font-medium">

        <Link to="/about" className="cursor-pointer hover:text-indigo-600 transition">
          About Us
        </Link>

        {!user && (
          <>
            <div className="relative" ref={registerRef}>
              <button
                onClick={() => {
                  setShowRegister(!showRegister);
                  setShowLogin(false);
                }}
                className="hover:text-indigo-600 transition"
              >
                Register
              </button>

              {showRegister && (
                <div className="absolute right-0 mt-3 w-44 bg-white rounded-xl shadow-lg flex flex-col p-3 gap-2 border border-gray-200">
                  <Link to="/shop_register" className="hover:bg-indigo-50 p-2 rounded-lg">
                    Shopkeeper
                  </Link>
                  <Link to="/worker_register" className="hover:bg-indigo-50 p-2 rounded-lg">
                    Worker
                  </Link>
                </div>
              )}
            </div>

            <div className="relative" ref={loginRef}>
              <button
                onClick={() => {
                  setShowLogin(!showLogin);
                  setShowRegister(false);
                }}
                className="hover:text-indigo-600 transition"
              >
                Login
              </button>

              {showLogin && (
                <div className="absolute right-0 mt-3 w-44 bg-white rounded-xl shadow-lg flex flex-col p-3 gap-2 border border-gray-200">
                  <Link to="/shop_login" className="hover:bg-indigo-50 p-2 rounded-lg">
                    Shopkeeper
                  </Link>
                  <Link to="/worker_login" className="hover:bg-indigo-50 p-2 rounded-lg">
                    Worker
                  </Link>
                </div>
              )}
            </div>
          </>
        )}

        {user && (
          <div className="relative" ref={userRef}>
            <button
              onClick={() => setShowUserMenu(!showUserMenu)}
              className="w-10 h-10 rounded-full bg-indigo-500 text-white flex items-center justify-center font-semibold hover:bg-indigo-600 transition"
            >
              U
            </button>

            {showUserMenu && (
              <div className="absolute right-0 mt-3 w-40 bg-white rounded-xl shadow-lg flex flex-col p-3 gap-2 border border-gray-200">
                <Link
                  to="/profile"
                  className="hover:bg-indigo-50 p-2 rounded-lg"
                >
                  Profile
                </Link>

                <button
                  onClick={handleLogout}
                  className="text-left hover:bg-red-50 text-red-500 p-2 rounded-lg"
                >
                  Logout
                </button>
              </div>
            )}
          </div>
        )}

      </div>
    </div>
  );
};

export default Header;