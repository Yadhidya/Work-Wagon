import { useState } from "react";
import Shops from "./shops";
import Workers from "./workers";

const Tabs = () => {
  const [activeTab, setActiveTab] = useState("shops");

  return (
    <div className="py-8">

      <div className="flex justify-center mb-12">
        <div className="bg-white rounded-full shadow-md p-2 flex gap-2">
          <button
            onClick={() => setActiveTab("shops")}
            className={`px-8 py-2 rounded-full font-medium transition ${
              activeTab === "shops"
                ? "bg-indigo-500 text-white shadow"
                : "text-gray-600 hover:bg-indigo-50"
            }`}
          >
            Shops
          </button>

          <button
            onClick={() => setActiveTab("workers")}
            className={`px-8 py-2 rounded-full font-medium transition ${
              activeTab === "workers"
                ? "bg-indigo-500 text-white shadow"
                : "text-gray-600 hover:bg-indigo-50"
            }`}
          >
            Workers
          </button>
        </div>
      </div>

      <div className="max-w-7xl mx-auto">
        {activeTab === "shops" ? <Shops /> : <Workers />}
      </div>

    </div>
  );
};

export default Tabs;