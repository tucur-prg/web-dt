
function validCreditCard(cardNumber)
{
    var sum = 0;
    var lenNumber = cardNumber.length;
    for (var k = lenNumber % 2; k < lenNumber; k += 2) {
        if ((Math.floor(cardNumber.substr(k, 1) * 2)) > 9) {
            sum += (Math.floor(cardNumber.substr(k, 1)) * 2) - 9;
        } else {
            sum += Math.floor(cardNumber.substr(k, 1)) * 2;
        }
    }

    for (k = (lenNumber % 2) ^ 1; k < lenNumber; k += 2) {
        sum += Math.floor(cardNumber.substr(k, 1));
    }

    return sum % 10 ? false : true;
}

function createNumber(first)
{
    var num;

    first = parseInt(first);
    if (!first) {
        first = 0;
    }

    first = new String(first);

    while (1) {
        num = new String(parseInt(Math.random() * 1000000000000000));
        num = first + num;

        if (num.length == 16) {
            if (validCreditCard(num)) {
                if (num.charAt(15) != 7) {
                    break;
                }
            }
        }
    }

    return num;
}

