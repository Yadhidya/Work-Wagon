import { useEffect, useState } from "react";

const Profile = () => {

  const [data, setData] = useState(null);

  useEffect(() => {

    const shop = localStorage.getItem("shop");
    const worker = localStorage.getItem("worker");

    let url = "";

    if (shop) url = "http://localhost:8080/shop/profile";
    if (worker) url = "http://localhost:8080/worker/profile";

    if (url) {
      fetch(url, {
        credentials: "include"
      })
        .then(res => {
          if (!res.ok) throw new Error("Unauthorized");
          return res.json();
        })
        .then(data => setData(data))
        .catch(() => {
          alert("Please login again");
        });
    }

  }, []);

  if (!data) {
    return (
      <div className="min-h-screen flex items-center justify-center text-gray-500">
        Loading profile...
      </div>
    );
  }

  const imageSrc = data.imageData
    ? `data:${data.imageType};base64,${data.imageData}`
    : null;

  const isShop = data.shop_name !== undefined;
  const isWorker = data.worker_name !== undefined;

  return (
    <div className="min-h-screen bg-gray-100 flex justify-center items-center p-6">

      <div className="bg-white rounded-3xl shadow-xl w-full max-w-2xl overflow-hidden">

        {/* Profile Header */}
        <div className="bg-indigo-500 p-6 flex items-center gap-6">

          {imageSrc ? (
            <img
              src={imageSrc}
              alt="profile"
              className="w-20 h-20 rounded-full object-cover border-4 border-white"
            />
          ) : (
            <div className="w-20 h-20 rounded-full bg-white flex items-center justify-center text-indigo-600 font-bold text-2xl">
              {isShop ? data.shop_name?.charAt(0) : data.worker_name?.charAt(0)}
            </div>
          )}

          <div className="text-white">
            <h2 className="text-2xl font-bold">
              {isShop ? data.shop_name : data.worker_name}
            </h2>

            <span className="text-sm bg-white text-indigo-600 px-3 py-1 rounded-full font-medium">
              {isShop ? "Shopkeeper" : "Worker"}
            </span>
          </div>

        </div>

        {/* Profile Body */}
        <div className="p-8 space-y-4 text-gray-700">

          {isShop && (
            <>
              <div className="grid grid-cols-2 gap-4">

                <p><span className="font-semibold">Shop Keeper</span><br />{data.shop_keeper_name}</p>

                <p><span className="font-semibold">Email</span><br />{data.email}</p>

                <p><span className="font-semibold">Mobile</span><br />{data.mobile}</p>

                <p><span className="font-semibold">Job Role</span><br />{data.job_name}</p>

                <p><span className="font-semibold">Vacancies</span><br />{data.available}</p>

              </div>
            </>
          )}

          {isWorker && (
            <>
              <div className="grid grid-cols-2 gap-4">

                <p><span className="font-semibold">Email</span><br />{data.email}</p>

                <p><span className="font-semibold">Mobile</span><br />{data.mobile}</p>

                <p><span className="font-semibold">Work Known</span><br />{data.work_known}</p>

                <p><span className="font-semibold">Age</span><br />{data.age}</p>

                <p><span className="font-semibold">City</span><br />{data.city}</p>

                <p><span className="font-semibold">Expected Salary</span><br />₹{data.salary}</p>

                <p>
                  <span className="font-semibold">Availability</span><br />
                  <span className={`px-3 py-1 rounded-full text-sm font-medium ${data.available === "Yes" || data.available === true ? "bg-green-100 text-green-600" : "bg-red-100 text-red-600"}`}>
                    {data.available}
                  </span>
                </p>

              </div>
            </>
          )}

          {/* Edit Button */}
          <div className="pt-6 flex justify-center">
            <button className="bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-2 rounded-xl transition">
              Edit Profile
            </button>
          </div>

        </div>

      </div>

    </div>
  );
};

export default Profile;