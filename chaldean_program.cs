using System;
using System.Collections.Generic;

class Program
{
    static void Main(string[] args)
    {
        Dictionary<char, int> chaldean = new Dictionary<char, int>
        {
            {' ', 0}, {'a', 1}, {'b', 2}, {'c', 3}, {'d', 4}, {'e', 5}, {'f', 8}, {'g', 3},
            {'h', 5}, {'i', 1}, {'j', 1}, {'k', 2}, {'l', 3}, {'m', 4}, {'n', 5}, {'o', 7},
            {'p', 8}, {'q', 1}, {'r', 2}, {'s', 3}, {'t', 4}, {'u', 6}, {'v', 6}, {'w', 6},
            {'x', 5}, {'y', 1}, {'z', 7}
        };

        Console.Write("Please enter your name: ");
        string nameInput = Console.ReadLine().ToLower();
        string[] nameSplit = nameInput.Split(' ');

        List<int> indiv = new List<int>();
        List<int> indivChiero = new List<int>();

        foreach (string name in nameSplit)
        {
            int sumC = 0;
            foreach (char c in name)
            {
                sumC += chaldean.ContainsKey(c) ? chaldean[c] : 0;
            }

            indiv.Add(sumC);

            if (sumC == 11 || sumC == 22)
            {
                indivChiero.Add(sumC);
            }
            else
            {
                indivChiero.Add(sumC.ToString().Select(c => int.Parse(c.ToString())).Sum());
            }
        }

        int total = indiv.Sum();
        int totalChiero = indivChiero.Sum();

        Console.WriteLine($"Chaldean: {string.Join(", ", indiv)} & {total} {char.ToUpper(nameInput[0]) + nameInput.Substring(1)}");
        Console.WriteLine($"ChieroLG: {string.Join(", ", indivChiero)} & {totalChiero} {char.ToUpper(nameInput[0]) + nameInput.Substring(1)}");
    }
}
