const structureHtml = async () => {
    try {
        let verifyUrl = `${location.origin}/api/verify`;
        let config = { headers: { Authorization: `Bearer ${localStorage.getItem('token')}` } };
        await axios.get(verifyUrl, config);
    } catch (error) {
        localStorage.clear();
        location.href = '/connexion';
    }
}

structureHtml();