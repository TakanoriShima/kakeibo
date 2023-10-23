import Chart from 'mychart.js';

console.log('ok');
    const ctx = document.getElementById("myPieChart");
    const myPieChart = new Chart(ctx, {
      type: 'pie', // 円グラフを使用
      data: {
        labels: ["A型", "O型", "B型", "AB型"],
        datasets: [{
          backgroundColor: [
            "#BB5179",
            "#FAFF67",
            "#58A27C",
            "#3C00FF"
          ],
          data: [38, 31, 21, 10]
        }]
      },
      options: {
          }
    });
// const ctx = document.getElementById("myPieChart");
//     const myPieChart = new Chart(ctx, {
//       type: 'pie', // 円グラフを使用
//       data: {
//         labels: ["A型", "O型", "B型", "AB型"],
//         datasets: [{
//           backgroundColor: [
//             "#BB5179",
//             "#FAFF67",
//             "#58A27C",
//             "#3C00FF"
//           ],
//           data: [38, 31, 21, 10]
//         }]
//       },
//       options: {
//           }
//     });

    // var ctx = document.getElementById('chart').getContext('2d');
    //     var chart = new Chart(ctx, {
    //         type: 'pie',
    //         data: {
    //             labels: @json($labels),
    //             datasets: [{
    //                 label: 'My Dataset',
    //                 data: @json($data),
    //           backgroundColor: [
    //               'rgba(255, 99, 132, 0.2)',
    //               'rgba(54, 162, 235, 0.2)',
    //               'rgba(255, 206, 86, 0.2)',
    //               'rgba(75, 192, 192, 0.2)',
    //               'rgba(153, 102, 255, 0.2)',
    //               'rgba(255, 159, 64, 0.2)'
    //           ],
    //           borderColor: [
    //               'rgba(255, 99, 132, 1)',
    //               'rgba(54, 162, 235, 1)',
    //               'rgba(255, 206, 86, 1)',
    //               'rgba(75, 192, 192, 1)',
    //               'rgba(153, 102, 255, 1)',
    //               'rgba(255, 159, 64, 1)'
    //           ],
    //           borderWidth: 1
    //             }]
    //         },
    //         options: {
    //             scales: {
    //                 y: {
    //                     beginAtZero: true
    //                 }
    //             }
    //         }
    //     });