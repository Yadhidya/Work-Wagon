<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorting Visualization</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .bar {
            width: 20px;
            margin: 0 2px;
            background-color: #3498db;
            display: inline-block;
        }
    </style>
</head>

<body>
    <div id="bars"></div>
    <button onclick="sortBars()">Sort Bars</button>

    <script>
        function generateBars(numBars) {
            const barsContainer = document.getElementById("bars");
            barsContainer.innerHTML = "";
            for (let i = 0; i < numBars; i++) {
                const barHeight = Math.floor(Math.random() * 300) + 1;
                const bar = document.createElement("div");
                bar.className = "bar";
                bar.style.height = `${barHeight}px`;
                barsContainer.appendChild(bar);
            }
        }

        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        async function bubbleSort() {
            const bars = document.querySelectorAll(".bar");
            const len = bars.length;
            for (let i = 0; i < len - 1; i++) {
                for (let j = 0; j < len - 1 - i; j++) {
                    const bar1 = bars[j];
                    const bar2 = bars[j + 1];
                    const height1 = parseInt(bar1.style.height);
                    const height2 = parseInt(bar2.style.height);

                    if (height1 > height2) {
                        await sleep(100);
                        bar1.style.backgroundColor = "#e74c3c";
                        bar2.style.backgroundColor = "#e74c3c";

                        // Swap heights
                        bar1.style.height = `${height2}px`;
                        bar2.style.height = `${height1}px`;

                        await sleep(100);
                        bar1.style.backgroundColor = "#3498db";
                        bar2.style.backgroundColor = "#3498db";
                    }
                }
            }
        }

        async function sortBars() {
            await bubbleSort();
        }

        generateBars(20); // Generate 20 bars initially
    </script>
</body>

</html>
