// دالة عامة لإرسال أي طلب مع التوكن الحالي
async function fetchWithAuth(url, options = {}) {
    let token = localStorage.getItem('token');

    if (!options.headers) {
        options.headers = {};
    }

    // ضيف التوكن في الهيدر
    options.headers['Authorization'] = `Bearer ${token}`;
    options.headers['Accept'] = 'application/json';

    let response = await fetch(url, options);

    if (response.status === 401) {
        const data = await response.json();

        if (data.error === 'token_expired') {
            // لو التوكن منتهي، روح على /api/refresh
            const refreshResponse = await fetch('/api/refresh', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                }
            });

            const refreshData = await refreshResponse.json();

            if (refreshResponse.ok) {
                const newToken = refreshData.msg;

                // خزن التوكن الجديد
                localStorage.setItem('token', newToken);

                // عيد إرسال الريكوست اللي كان فشل
                options.headers['Authorization'] = `Bearer ${newToken}`;

                response = await fetch(url, options);
            } else {
                // مشكلة في التحديث، امسح التوكن وخليه يروح يسجل دخول من جديد مثلا
                localStorage.removeItem('token');
                throw new Error('Unable to refresh token');
            }
        } else {
            throw new Error('Unauthorized');
        }
    }

    return response;
}
