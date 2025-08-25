// export const load = async (serverLoadEvent) => {
//     try {
//         const {fetch} = serverLoadEvent;

//         // fetch date urls
//         const response = await fetch('http://localhost:3015/api/v1/dates/');
//         const urlArr = await response.json();

//         // use the url to fetch again
//         const fetchEach = urlArr.data.map(async (url) => {
//             const res = await fetch(`http://localhost:3015/api/v1${url}`);
//             return res.json();
//         });

//         // wait for all fetches
//         const data = await Promise.all(fetchEach);
//         return {data};
//     } catch (error) {
//         return {error};
//     }
// }

