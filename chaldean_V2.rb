# Chaldean numerology values
CHALEDEAN_VALUES = Hash.new(0).merge({
  ' ' => 0, 'a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5, 'f' => 8, 'g' => 3,
  'h' => 5, 'i' => 1, 'j' => 1, 'k' => 2, 'l' => 3, 'm' => 4, 'n' => 5, 'o' => 7,
  'p' => 8, 'q' => 1, 'r' => 2, 's' => 3, 't' => 4, 'u' => 6, 'v' => 6, 'w' => 6,
  'x' => 5, 'y' => 1, 'z' => 7
})

# Reduces a number to a single digit (Cheiro method)
def reduce_to_single_digit(n)
  while n >= 10
    n = n.digits.sum
  end
  n
end

# Reduces a number for Linda Goodman method, stops at 11 or 22
def reduce_for_linda_goodman(n)
  while n >= 10 && ![11, 22].include?(n)
    n = n.digits.sum
  end
  n
end

# Returns Chaldean totals for each name part
def calculate_chaldean_parts(name_parts)
  name_parts.map do |part|
    part.chars.sum { |char| CHALEDEAN_VALUES[char] }
  end
end

# Returns Linda Goodman reduced totals per name part
def calculate_linda_goodman_parts(name_parts)
  name_parts.map do |part|
    reduce_for_linda_goodman(part.chars.sum { |char| CHALEDEAN_VALUES[char] })
  end
end

# Returns Cheiro reduced totals per name part
def calculate_cheiro_parts(name_parts)
  name_parts.map do |part|
    reduce_to_single_digit(part.chars.sum { |char| CHALEDEAN_VALUES[char] })
  end
end

# Capitalizes each part of the name nicely
def format_name(name)
  name.strip.split.map(&:capitalize).join(' ')
end

# Main program
def main
  print 'Please enter your name: '
  name_input = gets&.strip&.downcase || ''

  if name_input.empty?
    puts 'Name cannot be empty. Please try again.'
    return
  end

  name_parts = name_input.split
  formatted_name = format_name(name_input)

  # Part-wise totals
  chaldean_parts = calculate_chaldean_parts(name_parts)
  linda_parts = calculate_linda_goodman_parts(name_parts)
  cheiro_parts = calculate_cheiro_parts(name_parts)

  # Final totals
  chaldean_total = chaldean_parts.sum
  linda_total = linda_parts.sum
  cheiro_total = cheiro_parts.sum

  # Output with aligned labels
  puts "\nNumerology totals for: #{formatted_name}"
  puts "#{'Chaldean Numerology'.ljust(24)}: #{chaldean_parts} & #{chaldean_total}"
  puts "#{'Linda Goodman Numerology'.ljust(24)}: #{linda_parts} & #{linda_total}"
  puts "#{'Cheiro Numerology'.ljust(24)}: #{cheiro_parts} & #{cheiro_total}"
end

# Run the program
main
