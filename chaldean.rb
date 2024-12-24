# Prints your Chaldean numerology name number & also Cheiro/Linda Goodman name number.
require 'set'

chaldean = Hash.new(0).merge({
  ' ' => 0, "a" => 1, "b" => 2, "c" => 3, "d" => 4, "e" => 5, "f" => 8, "g" => 3, "h" => 5,
  "i" => 1, "j" => 1, "k" => 2, "l" => 3, "m" => 4, "n" => 5, "o" => 7, "p" => 8, "q" => 1,
  "r" => 2, "s" => 3, "t" => 4, "u" => 6, "v" => 6, "w" => 6, "x" => 5, "y" => 1, "z" => 7
})

print "Please enter your name: "
name_input = gets.chomp.downcase
split_name = name_input.split

indiv = []
indiv_chiero = []

split_name.each do |word|
  sum_c = word.chars.map { |char| chaldean[char] }.sum
  indiv << sum_c

  if sum_c == 11 || sum_c == 22
    indiv_chiero << sum_c
  else
    indiv_chiero << sum_c.digits.sum
  end
end

total = indiv.sum
total_chiero = indiv_chiero.sum

puts "Chaldean Numerology: #{indiv} & #{total} for #{name_input.split.map(&:capitalize).join(' ')}"
puts "ChieroLG Numerology: #{indiv_chiero} & #{total_chiero} for #{name_input.split.map(&:capitalize).join(' ')}"
