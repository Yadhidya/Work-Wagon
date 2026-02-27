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
    return <div className="p-10 text-center">Loading profile...</div>;
  }

  return (
    <div className="min-h-screen bg-gray-100 flex justify-center items-center p-10">
      <div className="bg-white rounded-3xl shadow-xl p-10 w-full max-w-xl">

        <h2 className="text-2xl font-bold mb-6 text-center">
          My Profile
        </h2>

        <div className="space-y-3">

          {data.shop_name && (
            <>
              <p><strong>Shop Name:</strong> {data.shop_name}</p>
              <p><strong>Shop Keeper:</strong> {data.shop_keeper_name}</p>
              <p><strong>Email:</strong> {data.email}</p>
              <p><strong>Mobile:</strong> {data.mobile}</p>
              <p><strong>Job:</strong> {data.job_name}</p>
              <p><strong>Vacancies:</strong> {data.available}</p>
            </>
          )}

          {data.worker_name && (
            <>
              <p><strong>Name:</strong> {data.worker_name}</p>
              <p><strong>Email:</strong> {data.email}</p>
              <p><strong>Mobile:</strong> {data.mobile}</p>
              <p><strong>Work Known:</strong> {data.work_known}</p>
              <p><strong>Age:</strong> {data.age}</p>
              <p><strong>City:</strong> {data.city}</p>
              <p><strong>Salary:</strong> {data.salary}</p>
              <p><strong>Available:</strong> {data.available}</p>
            </>
          )}

        </div>
      </div>
    </div>
  );
};

export default Profile;