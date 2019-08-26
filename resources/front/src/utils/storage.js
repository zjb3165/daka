const set = (key, item) => {
    localStorage.setItem(key, JSON.stringify(item))
}

const get = (key) => {
    let r = localStorage.getItem(key)
    return r ? JSON.parse(r) : r
}

const remove = (key) => {
    localStorage.removeItem(key)
}

export default {
    set: set,
    get: get,
    remove: remove
}