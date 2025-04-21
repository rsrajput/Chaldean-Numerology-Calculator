import sys
from collections import defaultdict

# Chaldean numerology values
CHALEDEAN_VALUES = defaultdict(lambda: 0, {
    ' ': 0, "a": 1, "b": 2, "c": 3, "d": 4, "e": 5, "f": 8, "g": 3, "h": 5,
    "i": 1, "j": 1, "k": 2, "l": 3, "m": 4, "n": 5, "o": 7, "p": 8, "q": 1,
    "r": 2, "s": 3, "t": 4, "u": 6, "v": 6, "w": 6, "x": 5, "y": 1, "z": 7
})


def reduce_to_single_digit(n: int) -> int:
    """Reduces a number to a single digit (Cheiro method)."""
    while n >= 10:
        n = sum(int(digit) for digit in str(n))
    return n


def reduce_for_linda_goodman(n: int) -> int:
    """Reduces a number for Linda Goodman method, stops at 11 or 22."""
    while n not in (11, 22) and n >= 10:
        n = sum(int(digit) for digit in str(n))
    return n


def calculate_chaldean_parts(name_parts: list[str]) -> list[int]:
    """Returns Chaldean totals for each name part."""
    return [sum(CHALEDEAN_VALUES[char] for char in part) for part in name_parts]


def calculate_linda_goodman_parts(name_parts: list[str]) -> list[int]:
    """Returns Linda Goodman reduced totals per name part."""
    return [
        reduce_for_linda_goodman(sum(CHALEDEAN_VALUES[char] for char in part))
        for part in name_parts
    ]


def calculate_cheiro_parts(name_parts: list[str]) -> list[int]:
    """Returns Cheiro reduced totals per name part."""
    return [
        reduce_to_single_digit(sum(CHALEDEAN_VALUES[char] for char in part))
        for part in name_parts
    ]


def format_name(name: str) -> str:
    """Capitalizes each part of the name nicely."""
    return ' '.join(word.capitalize() for word in name.strip().split())


def process_name(name_input: str):
    """Process and output the numerology for a single name."""
    name_parts = name_input.split()
    formatted_name = format_name(name_input)

    # Part-wise totals
    chaldean_parts = calculate_chaldean_parts(name_parts)
    linda_parts = calculate_linda_goodman_parts(name_parts)
    cheiro_parts = calculate_cheiro_parts(name_parts)

    # Final totals
    chaldean_total = sum(chaldean_parts)
    linda_total = sum(linda_parts)
    cheiro_total = sum(cheiro_parts)

    # Output with aligned labels
    print(f"\nNumerology totals for: {formatted_name}")
    print(f"{'Chaldean Numerology'.ljust(24)}: {chaldean_parts} & {chaldean_total}")
    print(f"{'Linda Goodman Numerology'.ljust(24)}: {linda_parts} & {linda_total}")
    print(f"{'Cheiro Numerology'.ljust(24)}: {cheiro_parts} & {cheiro_total}")


def main():
    # If the -f flag is provided
    if len(sys.argv) > 2 and sys.argv[1] == '-f':
        file_name = sys.argv[2]
        try:
            with open(file_name, 'r') as file:
                names = file.readlines()
            # Process each name in the file
            for name in names:
                name = name.strip()  # remove extra whitespace
                if name:  # if the name is not empty
                    process_name(name)
        except FileNotFoundError:
            print(f"Error: The file '{file_name}' was not found.")
    else:
        # If no -f flag, ask the user for a single name
        name_input = input("Please enter your name: ").strip().lower()
        if not name_input:
            print("Name cannot be empty. Please try again.")
        else:
            process_name(name_input)


if __name__ == "__main__":
    main()
