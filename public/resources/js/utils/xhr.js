export async function xhr({ url, method = 'GET', responseType = 'text', errorHandler = () => {}, beforeResponse = async () => {}, beforeRequest = async () => {}, afterResponse = async () => {}, headers = {}, body = null }) {
    try {
        const options = {
            method: method,
            headers: headers,
            body: body
        };

        if(beforeRequest) {
            await beforeRequest();
        }
        const response = await fetch(url, options);
        if(beforeResponse) {
            await beforeResponse();
        }
        if(response.ok){

            if(responseType === 'json'){

                const result = await response.json();
                if(afterResponse) {
                    await afterResponse(result);
                }
                return result;
            }

            const result = await response.text();

            if(afterResponse) {
                await afterResponse(result);
            }
            return result;

        }
        else {
            errorHandler('Something went wrong');
        }

    } catch (error) {
        errorHandler('Something went wrong');

    }
}