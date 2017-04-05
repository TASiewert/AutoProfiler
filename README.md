# PHP - AutoProfiler - Face Analysis API

Utilize the Haystack API (free account required from [Haystack Face Analysis API](https://www.haystack.ai/user/signup)) to automatically pre-fill some basic info about a user's profile based on his or her profile picture. 
__Note:__ this only works on photos containing only one face. 

### Features
- Gender Detection (using API)
- Ethnicity Detection (using API)
- Age Detection (using API)
- Attractiveness (using API)
- Emotion (using API)
- Face Bounding Rectangle (using API)

### Pre-filled fields
- Gender (and confidence score)
- Ethnicity (and confidence score)
- Age

__Note:__ Haystack can show other information like attractiveness, emotion, and face bounding rectangle. Gender, ethnicity, and age are the most common for profiles, however.

## Installation
Copy `autoprofile.php` into your project directory.

## Usage
```php
$imageData = file_get_contents($_FILES["picture"]["tmp_name"]); 
$autoProfiler = new AutoProfiler("API KEY");
$data = $autoProfiler->getProfileInformation($imageData);
```
### Output
```php
array(
   'gender' => 'female',
   'genderConfidence' => 0.99880000000000002113864638886298052966594696044921875,
   'age' => 53.7000000000000028421709430404007434844970703125,
   'ethnicity' => 'White_Caucasian',
   'ethnicityConfidence' => 0.8973999999999999754862756162765435874462127685546875,
)
```
if the input image is invalid or contains more than one person
```php
null
```
