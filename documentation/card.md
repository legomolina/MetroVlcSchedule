<div class="doc-menu">
    <ul>
        <li><a href="stations">Stations</a></li>
        <li><a href="routes">Routes</a></li>
        <li><a href="card">Card</a></li>
    </ul>
</div>

## Card

<span id="balance"></span>

### GET api/v1/card/{card_number}/balance
Returs the card number with the available zones and the balance for it.

#### Resource URL

https://metrovlcschedule.herokuapp.com/api/v1/card/{card_number:\d{10}}/balance

#### Resource information

Response format | JSON
Requires authentication | No

#### Parameters

|Name|Required|Description|Default Value|Example|
|:---:|:------:|-----------|-------------|:-----:|
|card_number|required|10 digits number that specifies the card number.| |8564853124|


#### Example request

GET https://metrovlcschedule.herokuapp.com/api/v1/card/8564853124/balance

#### Example response

```json
{
  "cardNumber": "8564853124",
  "cardZones": "Bonometro zona A",
  "cardBalance": "4"
}
```
