class Converter{

    //turn a "2020-01-01" date into separate numbers in array
    dateToInt(date){
        let newDate = new Date(date);
        let dateNumbers = {
            day: newDate.getDate(),
            month: newDate.getMonth() + 1,
            year: newDate.getFullYear()
        };
        return dateNumbers;
    }

    //turn separate numbers into "2020-01-01" format
    intToDate(day, month, year){
        if(day.length < 2){ day = "0" + day; }
        if(month.length < 2){ month = "0" + month; }
        return year + "-" + month + "-" + day;
    }

}
