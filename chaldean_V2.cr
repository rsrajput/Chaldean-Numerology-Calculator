# Chaldean numerology values
CHALEDEAN_VALUES = {
  ' ' => 0, 'a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5, 'f' => 8, 'g' => 3,
  'h' => 5, 'i' => 1, 'j' => 1, 'k' => 2, 'l' => 3, 'm' => 4, 'n' => 5, 'o' => 7,
  'p' => 8, 'q' => 1, 'r' => 2, 's' => 3, 't' => 4, 'u' => 6, 'v' => 6, 'w' => 6,
  'x' => 5, 'y' => 1, 'z' => 7
}

# Returns value for character or 0 if not found
def chaldean_value(c : Char) : Int32
  CHALEDEAN_VALUES.fetch(c, 0)
end

# Reduces a number to a single digit (Cheiro method)
def reduce_to_single_digit(n : Int32) : Int32
  while n >= 10
    n = n.to_s.chars.map(&.to_i).sum
  end
  n
end

# Reduces a number for Linda Goodman method (stops at 11 or 22)
def reduce_for_linda_goodman(n : Int32) : Int32
  while n >= 10 && n != 11 && n != 22
    n = n.to_s.chars.map(&.to_i).sum
  end
  n
end

# Returns Chaldean totals for each name part
def calculate_chaldean_parts(name_parts : Array(String)) : Array(Int32)
  name_parts.map do |part|
    part.chars.map { |c| chaldean_value(c) }.sum
  end
end

# Returns Linda Goodman reduced totals per name part
def calculate_linda_goodman_parts(name_parts : Array(String)) : Array(Int32)
  name_parts.map do |part|
    reduce_for_linda_goodman(part.chars.map { |c| chaldean_value(c) }.sum)
  end
end

# Returns Cheiro reduced totals per name part
def calculate_cheiro_parts(name_parts : Array(String)) : Array(Int32)
  name_parts.map do |part|
    reduce_to_single_digit(part.chars.map { |c| chaldean_value(c) }.sum)
  end
end

# Capitalizes each part of the name nicely
def format_name(name : String) : String
  name.strip.split.map(&.capitalize).join(" ")
end

# Main program
def main
  print "Please enter your name: "
  name_input = gets.to_s.strip.downcase

  if name_input.empty?
    puts "Name cannot be empty. Please try again."
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
  puts "Chaldean Numerology         : #{chaldean_parts} & #{chaldean_total}"
  puts "Linda Goodman Numerology    : #{linda_parts} & #{linda_total}"
  puts "Cheiro Numerology           : #{cheiro_parts} & #{cheiro_total}"
end

# Run main if executed
main
