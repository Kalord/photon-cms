const getFirstProperty = (object) => {
    for (let i in object) {
        return object[i];
    }
};
