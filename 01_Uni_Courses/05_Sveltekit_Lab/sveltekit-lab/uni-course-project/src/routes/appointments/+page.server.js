const fetchData = async (url) => {
    try {
        const response = await fetch(url);
        const items = await response.json();
        return items;
    } catch (error) {
        return {error};
    }
}

export const load = async () => {
    // fetch appointment urls : {"meta": {"count": 5, "title...}, "data": ["/appointments/1", "/appointments/2...]}
    const urlArr = await fetchData('http://localhost:3015/api/v1/appointments/');
    const urlArrData = urlArr.data;
    // use each url to fetch again
    const fetchEach = urlArrData.map((url)=>fetchData(`http://localhost:3015/api/v1${url}`));
    // wait for all promises to resolve
    try {
        const data = await Promise.all(fetchEach);
        return {data};
    } catch (error) {
        return {error};
    }
}

