import { useState } from "react";
import { Link } from "react-router-dom";

const ShopRegister = () => {
  const [shop, setShop] = useState({
    shop_name: "",
    job_name: "",
    shop_keeper_name: "",
    mobile: "",
    email: "",
    available: "",
    password: ""
  });

  const [imageFile, setImageFile] = useState(null);

  const handleChange = (e) => {
    setShop({
      ...shop,
      [e.target.name]: e.target.value
    });
  };

  const handleImageChange = (e) => {
    setImageFile(e.target.files[0]);
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    const formData = new FormData();
    formData.append(
      "shop",
      new Blob([JSON.stringify(shop)], { type: "application/json" })
    );
    formData.append("imageFile", imageFile);

    try {
      const response = await fetch("http://localhost:8080/shop", {
        method: "POST",
        body: formData
      });

      if (response.ok) {
        alert("Shop registered successfully");
      } else {
        alert("Failed to register");
      }
    } catch (error) {
      console.error("Error:", error);
    }
  };

  return (
    <div className="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-100 via-white to-purple-100 px-4">
      <div className="w-full max-w-2xl bg-white rounded-3xl shadow-xl p-10">

        <h2 className="text-3xl font-bold text-center text-gray-800 mb-8">
          Shop Registration
        </h2>

        <form className="grid grid-cols-1 md:grid-cols-2 gap-5" onSubmit={handleSubmit}>

          <div className="flex flex-col">
            <label className="text-sm font-medium text-gray-600 mb-1">Shop Name</label>
            <input
              type="text"
              name="shop_name"
              onChange={handleChange}
              required
              className="px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
            />
          </div>

          <div className="flex flex-col">
            <label className="text-sm font-medium text-gray-600 mb-1">Job Name</label>
            <input
              type="text"
              name="job_name"
              onChange={handleChange}
              required
              className="px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
            />
          </div>

          <div className="flex flex-col">
            <label className="text-sm font-medium text-gray-600 mb-1">Shop Keeper Name</label>
            <input
              type="text"
              name="shop_keeper_name"
              onChange={handleChange}
              required
              className="px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
            />
          </div>

          <div className="flex flex-col">
            <label className="text-sm font-medium text-gray-600 mb-1">Mobile Number</label>
            <input
              type="text"
              name="mobile"
              onChange={handleChange}
              required
              className="px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
            />
          </div>

          <div className="flex flex-col md:col-span-2">
            <label className="text-sm font-medium text-gray-600 mb-1">Email</label>
            <input
              type="email"
              name="email"
              onChange={handleChange}
              required
              className="px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
            />
          </div>

          <div className="flex flex-col">
            <label className="text-sm font-medium text-gray-600 mb-1">Available Vacancies</label>
            <input
              type="number"
              name="available"
              onChange={handleChange}
              required
              className="px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
            />
          </div>

          <div className="flex flex-col">
            <label className="text-sm font-medium text-gray-600 mb-1">Password</label>
            <input
              type="password"
              name="password"
              onChange={handleChange}
              required
              className="px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
            />
          </div>

          <div className="flex flex-col md:col-span-2">
            <label className="text-sm font-medium text-gray-600 mb-1">Upload Image</label>
            <input
              type="file"
              accept="image/*"
              onChange={handleImageChange}
              className="text-sm"
            />
          </div>

          <div className="md:col-span-2">
            <button
              type="submit"
              className="w-full mt-4 bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-3 rounded-xl transition duration-300"
            >
              Register
            </button>
          </div>

        </form>

        <p className="text-sm text-center text-gray-500 mt-6">
          Already have an account?{" "}
          <Link
            to="/shop_login"
            className="text-indigo-600 font-medium hover:underline"
          >
            Login here
          </Link>
        </p>

      </div>
    </div>
  );
};

export default ShopRegister;