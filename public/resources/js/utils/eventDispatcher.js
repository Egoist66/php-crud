export function eventDispatcher(element, eventName,  callback) {
    const e = new CustomEvent(eventName, {
        detail: {
            name: eventName,
            isSynthetic: true
        }
    })

    if(element){
        element.addEventListener(eventName, function(e){
            callback(e)
        })

        element.dispatchEvent(e)
    }

}