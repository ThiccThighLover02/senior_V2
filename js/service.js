const getData = (url, fetchOptions = {}) => {
    if(url){
        return fetch(`http://localhost/new_systemV2/${url}`, fetchOptions)
    }
    return fetch('http://localhost/new_systemV2')
}

export default getData;