
var usersArr = [
    {username: 'Jan Kowalski', birthYear: 1983, salary: 4200},
    {username: 'Anna Nowak', birthYear: 1994, salary: 7500},
    {username: 'Jakub Jakubowski', birthYear: 1985, salary: 18000},
    {username: 'Piotr Kozak', birthYear: 2000, salary: 4999},
    {username: 'Marek Sinica', birthYear: 1989, salary: 7200},
    {username: 'Kamila Wiśniewska', birthYear: 1972, salary: 6800},
];

function welcomeUsers(array) {
    array.forEach(element => {
        if (element.salary > 15000) {
            console.log('Witaj, prezesie!');
        } else if (element.salary < 5000) {
            console.log(`${element.username}, szykuj się na podwyżkę!`);
        } else {
            if (element.birthYear % 2 == 0) {
                const today = new Date();
                const year = today.getFullYear();
                const wiek_rocznikowy = year - element.birthYear;
                console.log(`Witaj, ${element.username}! W tym roku
                kończysz ${wiek_rocznikowy} lat!`);
            } else {
                console.log(`${element.username}, jesteś zwolniony!`)
            }
        }
    });
}

welcomeUsers(usersArr);