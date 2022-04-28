let transliterator = new Object();

transliterator.transliterate = function (text, from_language, into_language = 'en')
{
  var answer = '';
  var dictionary = [];

  dictionary['ru'] = [];
  dictionary['ru']['en'] = {
    'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd',
    'е': 'e', 'ё': 'e', 'ж': 'zh', 'з': 'z', 'и': 'i',
    'й': 'y', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n',
    'о': 'o', 'п': 'p', 'р': 'r', 'с': 's', 'т': 't',
    'у': 'u', 'ф': 'f', 'х': 'h', 'ц': 'c', 'ч': 'ch',
    'ш': 'sh', 'щ': 'sch', 'ь': '', 'ы': 'y', 'ъ': '',
    'э': 'e', 'ю': 'yu', 'я': 'ya'
  };

  dictionary['ua'] = [];
  dictionary['ua']['en'] = {
    "а": 'a', "б": 'b', "в": 'v', "г": 'g', "д": 'd', 
    "е": 'e', "є": 'je', "ж": 'zh', "з": 'z', "і": 'i', 
    "ї": 'ji', "й": 'j', "к": 'k', "л": 'l', "м": 'm', "н": 'n', 
    "о": 'o', "п": 'p', "р": 'r', "с": 's', "т": 't', "у": 'u', 
    "ф": 'f', "х": 'kh', "ц": 'ts', "ч": 'ch', "ш": 'sh', "щ": 'sch', 
    "и": 'y', "ь": '\'', "ю": 'yu', "я": 'ya', '\'': 'j'
  };

  if (dictionary[from_language] !== undefined) {
    if (dictionary[from_language][into_language] !== undefined) {

      text = text.split('');
      dictionary = dictionary[from_language][into_language];

      for (var i = 0; i < text.length; i++) {

        var letter = String(text[i]);

        if (dictionary[letter.toLowerCase()] !== undefined) {

          if (letter.toUpperCase() !== letter) {

            answer += dictionary[letter];

          } else {

            letter = letter.toLowerCase();
            transliterator_letter = dictionary[letter].split('');
            answer += transliterator_letter[0].toUpperCase() + transliterator_letter.slice(1);
          }

        } else {

          answer += letter;
        }
      }

      return answer;
    }
  }

  return null;
};

transliterator.format_uri = function (text)
{
  answer = text.toLowerCase();
  answer = answer.replace(/[^-0-9a-z]/g, '-');
  answer = answer.replace(/[-]+/g, '-');
  answer = answer.replace(/^\-|-$/g, ''); 
  return answer;
};