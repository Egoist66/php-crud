export function debounce(func, delay) {
    let timeoutId;

    return () => {
        clearTimeout(timeoutId);

        timeoutId = setTimeout(() => {
            func.apply(this, arguments);
        }, delay);
    };
}