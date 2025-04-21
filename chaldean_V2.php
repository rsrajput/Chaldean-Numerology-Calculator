<?php
function reduceToSingleDigit($number) {
    while ($number >= 10) {
        $digits = str_split((string)$number);
        $number = array_sum($digits);
    }
    return $number;
}

function reduceForLindaGoodman($number) {
    while (!in_array($number, [11, 22]) && $number >= 10) {
        $digits = str_split((string)$number);
        $number = array_sum($digits);
    }
    return $number;
}

function calculatePartSums($nameParts, $method) {
    global $chaldeanValues;
    $results = [];

    foreach ($nameParts as $part) {
        $partSum = 0;
        $chars = str_split(strtolower($part));

        foreach ($chars as $char) {
            $partSum += $chaldeanValues[$char] ?? 0;
        }

        if ($method === 'chaldean') {
            $results[] = $partSum;
        } elseif ($method === 'linda') {
            $results[] = reduceForLindaGoodman($partSum);
        } elseif ($method === 'cheiro') {
            $results[] = reduceToSingleDigit($partSum);
        }
    }

    return $results;
}

$chaldeanValues = [
    'a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5,
    'f' => 8, 'g' => 3, 'h' => 5, 'i' => 1, 'j' => 1,
    'k' => 2, 'l' => 3, 'm' => 4, 'n' => 5, 'o' => 7,
    'p' => 8, 'q' => 1, 'r' => 2, 's' => 3, 't' => 4,
    'u' => 6, 'v' => 6, 'w' => 6, 'x' => 5, 'y' => 1,
    'z' => 7, ' ' => 0
];

$name = $_POST['name'] ?? '';

?>
<!DOCTYPE html>
<html>
<head>
    <title>Chaldean Numerology Calculator</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        input[type="text"] { padding: 8px; width: 300px; }
        input[type="submit"] { padding: 8px 16px; }
        .result { margin-top: 20px; padding: 10px; background: #fff; border: 1px solid #ccc; }
        .row-label { display: inline-block; width: 30ch; font-weight: bold; }
    </style>
</head>
<body>

<h2>Chaldean Numerology Calculator</h2>

<form method="post">
    <label>Enter your name:</label><br><br><br><br>
    <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required>
    <input type="submit" value="Calculate">
</form>

<?php if (!empty($name)): ?>
    <?php
    $nameParts = preg_split('/\s+/', trim($name));
    $formattedName = ucwords(strtolower($name));

    $chaldeanParts = calculatePartSums($nameParts, 'chaldean');
    $lindaParts = calculatePartSums($nameParts, 'linda');
    $cheiroParts = calculatePartSums($nameParts, 'cheiro');

    $chaldeanTotal = array_sum($chaldeanParts);
    $lindaTotal = array_sum($lindaParts);
    $cheiroTotal = array_sum($cheiroParts);
    ?>

    <div class="result">
        <h3>Numerology Totals for: <?= htmlspecialchars($formattedName) ?></h3>
        <p><span class="row-label">Chaldean Numerology</span>: [<?= implode(', ', $chaldeanParts) ?>] & <?= $chaldeanTotal ?></p>
        <p><span class="row-label">Linda Goodman Numerology</span>: [<?= implode(', ', $lindaParts) ?>] & <?= $lindaTotal ?></p>
        <p><span class="row-label">Cheiro Numerology</span>: [<?= implode(', ', $cheiroParts) ?>] & <?= $cheiroTotal ?></p>
    </div>

<?php endif; ?>
<br><br>
<h1>Name number meaning:</h1>
10. Symbolized as the "Wheel of Fortune." It is a number of honor, of faith and self-confidence of rise and fall; one's name will be known for good or evil, according to one's desires; it is a fortunate number in the sense that one's plans are likely to be carried out.<br><br>

11. This is an ominous number to occultists. It gives warning of hidden dangers, trial, and treachery from others. It has a symbol of "a Clenched Hand," and "a Lion Muzzled," and of a person who will have great difficulties to contend against.<br><br>

12. The Symbolism of this number is suffering and anxiety of mind. It is also indicated as "the Sacrifice" or "the Victim" and generally foreshadows one being sacrificed for the plans or intrigues of others.<br><br>

13. This is a number indicating change of plans, place, and such-like, and is not unfortunate, as is generally supposed. In some of the ancient writings it is said, "He who understands the number 13 will be given power and dominion." It is Symbolized by the picture of "a Skeleton" or "Death," with a scythe reaping down men, in a field of new-grown grass where young faces and heads appear copping up on every side. it is a number of upheaval and destruction. It is a Symbol of "Power" which, if wrongly used, will wreak destruction upon itself. It is a number of warnings of the unknown or unexpected, if it becomes a "compound" number in one's calculations.<br><br>

14. This is number of movement, combination of people and things, and danger from natural forces, such as tempests, water, air, or fire. This number is fortunate for dealings with money, speculation, and changes in business, but there is always a strong element of risk and danger attached to it, but generally owing to the actions and foolhardiness of others. If this number comes out in calculations of future events the person should be warned to act with caution and prudence.<br><br>

15. This is number of occult significance, of magic and mystery; but as a rule it does not represent the higher side of occultism, its meaning being that the persons represented by it will use every art of magic they can to carry out their purpose. If associated with a good or fortunate single number, it can be very lucky and powerful, but if associated with one of the peculiar numbers, such as a 4 or an 8, the person it represents will not scruple to use any sort of art, or even "black magic," to gain what he or she desires. It is peculiarly associated with "good talkers", often with eloquence, gifts of Music and Art and a dramatic personality, combined with a certain voluptuous temperament and strong personal magnetism. For obtaining money, gifts, and favors from others it is a fortunate number.<br><br>

16. This number has a most peculiar occult symbolism. It is picture of a Tower Struck by Lightning, from which a man is falling with a Crown on his head." It is also called "the Shattered Citadel." It gives warning of some strange fatality awaiting one, also danger of accidents and defeat of one's plans. It appears as a "compound" number relating to the future, it is a warning sign that should be carefully noted and plans made in advance in the endeavor to avert its fatalistic tendency.<br><br>

17. This is a highly spiritual number, and is expressed in symbolism by the 8-pointed Star of Venus: a symbol of "Peace and Love". It is also called "the Star of the Magi" and expresses that the person it represents has risen superior in spirit to the trials and difficulties of his life or his career. It is considered a "number of immortality" and that the person's name "lives after him." It is a fortunate number if it works out in relation to future events, provided it is not associated with the single numbers of fours and eights.<br><br>

18. This number has a difficult symbolism to translate. It is pictured as "a rayed moon from which drops of blood are falling; a wolf and hungry dog are seen below catching the falling drops of blood in their opened mouths, while still lower a crab is seen hastening to join them." It is symbolic of materialism striving to destroy the spiritual side of the nature. It generally associates a person with bitter quarrels, even family ones, also with war, social upheavals, revolutions and in some cases it indicates making money and position through wars or by wars. It is, however, a warning of treachery, deception by others, also danger from the elements, such as storms, danger from water, fires and explosions. When this "compound" number appears in working out dates in advance such a date should be taken with a great amount of care, caution, and circumspection.<br><br>

19. This number is regarded as fortunate and extremely favorable. It is symbolized as "the Sun" and is called "the Prince of Heaven." It is a number promising happiness, success, esteem and honor, and promises success in one's plans for the future.<br><br>

20. This number is called "the Awakening"; also "the Judgment." It is symbolized by the figure of a winged angel sounding a trumpet, while from below, a man, a woman, and a child are seen rising from a tomb with their hands clasped in prayer. This number has a peculiar interpretation: the awakening of new purpose, new plans, new ambitions, the call to action but for some great purpose, cause or duty. It is not a material number and consequently is a doubtful one as far as worldly success is concerned. If used in relation to a future event, it denotes delays, hindrances to one's plans, which can only be conquered thorough the development of the spiritual side of the nature.<br><br>

21. This number is symbolized by the picture of "the Universe," and it is also called "the Crown of the Magi." It is a number of advancement, honors, elevation in life, and general success. It means victory after a long fight, for "the Crown of the Magi" is only gained after long initiation and tests of determination. It is a fortunate number of promise, if it appears in any connection with future events.<br><br>

22. This number is symbolized by "a Good Man blinded by the folly of others, with a knapsack on his back full of Errors." In this picture he appears to offer no defense against a ferocious tiger, which is attacking him. It is a warning number of illusion and delusion, a good person who lives in a fool's paradise; a dreamer of dreams who awakens only when surrounded by danger. It is also a number of false judgment owing to the influence of others. As a number in connection with future events its warning and meaning should be carefully noted.<br><br>

23. This number is called "the Royal Star of the Lion". It is a promise of success, help from superiors and protection from those in high places. In dealing with future events it is a most fortunate number and a promise of success for one's plans.<br><br>

24. This number is also fortunate; it promises the assistance and association of those of rank and position with one's plans; it also denotes gain thorough love and the opposite sex; it is a favorable number when it comes out in relation to future events.<br><br>

25. This is number denoting strength gained through experience and benefits obtained through observation of people and things. It is not deemed exactly "lucky", as its success is given through strife and trials in the earlier life. It is favorable when it appears in regard to the future.<br><br>

26. This number is full of the gravest warnings for the future. It foreshadows disasters brought about by association with others; ruin, by bad speculations, by partnerships, unions, and bad advice. If it comes out in connection with future events one should carefully consider the path one is treading.<br><br>

27. This is a good number. It is a promise of authority, power, and command. It indicates that reward will come from the productive intellect; that the creative faculties have sown good seeds that will reap a harvest. Persons with this "compound" number at their back should carry out their own ideas and plans. It is a fortunate number if it appears in any connection with future events.<br><br>

28. This number is full of contradictions. It indicates a person of great promise and possibilities who is likely to see all taken away from him unless he carefully provides for the future. It indicates loss through trust in others, opposition and competition in trade, danger of loss through law, and the likelihood of having to begin life's road over and over again. It is not a fortunate number for the indication of future events.<br><br>

29. This number indicates uncertainties, treachery, and deception of others; it foreshadows trials, tribulation, and unexpected dangers, unreliable friends, and grief and deception caused by members of the opposite sex. It gives grave warning if it comes out in anything concerning future events.<br><br>

30. This is a number of thoughtful deduction, retrospection, and mental superiority over one's fellows, but, as it seems to belong completely to the mental plane, the persons it represents are likely to put all material things on one side not because they have to, but because they wish to do so. For this reason it is neither fortunate nor unfortunate, for either depends on the mental outlook of the person it represents. It can be all powerful, but it is just as often indifferent according to the will or desire of the person.<br><br>

31. This number is very similar to the preceding one, except that the person it represents is even more self-contained, lonely, and isolated from his fellows. It is not a fortunate number from a worldly or material standpoint.<br><br>

32. This number has a magical power like the single 5, or the "compound" numbers 14 and 23. It is usually associated with combination of people or nations. It is a fortunate number if the person it represents, holds to his own judgment and opinions; if not, his plans are likely to become wrecked by the stubbornness and stupidity of others. It is a favorable number if it appears in connection with future events.<br><br>

33. This number has no potency of its own, and consequently has the same meaning as the 24-which is also a 6-and the next to it in its own series of "compound" numbers.<br><br>

34. Has the same meaning as the number 25, which is the next to it in its own series of "compound" numbers.<br><br>

35. Has the same meaning as the number 26, which is the next to it in its own series of "compound" numbers.<br><br>

36. Has the same meaning as the number 27, which is the next to it in its own series of "compound" numbers.<br><br>

37. This number has a distinct potency of its own. It is a number of good and fortunate friendships in love, and in combinations connected with the opposite sex. It is also good for partnerships of all kinds. It is a fortunate indication if it appears in connection with future events.<br><br>

38. Has the same meaning as the number 29, which is the next to it in its own series of "compound" numbers.<br><br>

39. Has the same meaning as the number 30, which is the next to it in its own series of "compound" numbers.<br><br>

40. Has the same meaning as the number 31, which is the next to it in its own series of "compound" numbers.<br><br>

41. Has the same meaning as the number 32, which is the next to it in its own series of "compound" numbers.<br><br>

42. Has the same meaning as the number 24.<br><br>

43. This is an unfortunate number. It is symbolized by the signs of revolution, upheaval, strife, failure, and prevention, and is not a fortunate number if it comes out in calculations relating to future events.<br><br>

44. Has the same meaning as 26.<br><br>

45. Has the same meaning as 27.<br><br>

46. Has the same meaning as 37.<br><br>

47. Has the same meaning as 29.<br><br>

48. Has the same meaning as 30.<br><br>

49. Has the same meaning as 31.<br><br>

50. Has the same meaning as 32.<br><br>

51. This number has a very powerful potency of its own. It represents the nature of the warrior; it promises sudden advancement in whatever one undertakes; it is especially favorable for those in military or naval life and for leaders in any cause. At the same time it threatens enemies, danger, and the likelihood of assassination.<br><br>

52. Has the same meaning as the number 43.<br><br>


</br>
</body>
</html>
