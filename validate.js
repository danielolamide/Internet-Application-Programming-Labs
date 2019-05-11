function validateForm(form){
    const fname = form.first_name.value;
    const lname = form.last_name.value;
    const city = form.city_name.value;
    if (fname === null || lname === '' || city === '') {
        alert('All required details are not provided');
        return false;
    }
    return false;
}   