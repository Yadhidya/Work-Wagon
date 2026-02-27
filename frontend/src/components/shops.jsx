import { useEffect, useState } from "react";

const Shops = () => {
  const [shops, setShops] = useState([]);
  const [loading, setLoading] = useState(true);
  const [selectedShop, setSelectedShop] = useState(null);
  const [isWorkerLoggedIn, setIsWorkerLoggedIn] = useState(false);

  useEffect(() => {
    fetch("http://localhost:8080/shops")
      .then((res) => res.json())
      .then((data) => {
        setShops(data);
        setLoading(false);
      })
      .catch(() => setLoading(false));

    const worker = localStorage.getItem("worker");
    if (worker) setIsWorkerLoggedIn(true);
  }, []);

  if (loading) {
    return <div className="text-center text-gray-500 text-lg mt-16">Loading shops...</div>;
  }

  if (shops.length === 0) {
    return <div className="text-center text-gray-500 text-lg mt-16">No shops available.</div>;
  }

  return (
    <>
      <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
        {shops.map((data) => (
          <div
            key={data.id}
            className="bg-white rounded-3xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden"
          >
            <div className="h-52 bg-gray-100 flex items-center justify-center overflow-hidden">
              {data.imageData && (
                <img
                  src={`data:${data.imageType};base64,${data.imageData}`}
                  alt={data.shop_name}
                  className="h-full w-full object-cover"
                />
              )}
            </div>

            <div className="p-5">
              <h3 className="text-lg font-semibold text-gray-800 mb-2">
                {data.shop_name}
              </h3>
              <p className="text-sm text-gray-600">Job: {data.job_name}</p>
              <p className="text-sm text-gray-600 mt-1">
                Vacancies: {data.available}
              </p>

              <button
                onClick={() => setSelectedShop(data)}
                className="mt-4 w-full bg-indigo-500 hover:bg-indigo-600 text-white py-2 rounded-xl transition"
              >
                View Details
              </button>
            </div>
          </div>
        ))}
      </div>

      {selectedShop && (
        <div className="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50">
          <div className="bg-white w-full max-w-lg rounded-3xl shadow-2xl p-8 relative">
            <button
              onClick={() => setSelectedShop(null)}
              className="absolute top-4 right-4 text-gray-500 hover:text-black"
            >
              ✕
            </button>

            {selectedShop.imageData && (
              <div className="h-52 bg-gray-100 rounded-xl overflow-hidden mb-5">
                <img
                  src={`data:${selectedShop.imageType};base64,${selectedShop.imageData}`}
                  alt={selectedShop.shop_name}
                  className="h-full w-full object-cover"
                />
              </div>
            )}

            <h2 className="text-2xl font-bold text-gray-800 mb-4">
              {selectedShop.shop_name}
            </h2>

            <div className="space-y-2 text-gray-700">
              <p><span className="font-semibold">Job:</span> {selectedShop.job_name}</p>
              <p><span className="font-semibold">Vacancies:</span> {selectedShop.available}</p>
              <p><span className="font-semibold">Shop Keeper:</span> {selectedShop.shop_keeper_name}</p>
              <p><span className="font-semibold">Email:</span> {selectedShop.email}</p>
              <p><span className="font-semibold">Mobile:</span> {selectedShop.mobile}</p>
            </div>

            {isWorkerLoggedIn && selectedShop.available > 0 && (
              <button className="mt-6 w-full bg-indigo-500 hover:bg-indigo-600 text-white py-3 rounded-xl transition">
                Request
              </button>
            )}
          </div>
        </div>
      )}
    </>
  );
};

export default Shops;