(ns numerology.core
  (:require [clojure.string :as str])
  (:gen-class))

;; Chaldean numerology values
(def chaldean-values
  {"a" 1 "b" 2 "c" 3 "d" 4 "e" 5 "f" 8 "g" 3 "h" 5
   "i" 1 "j" 1 "k" 2 "l" 3 "m" 4 "n" 5 "o" 7 "p" 8
   "q" 1 "r" 2 "s" 3 "t" 4 "u" 6 "v" 6 "w" 6 "x" 5
   "y" 1 "z" 7 " " 0})

(defn char-value [ch]
  (get chaldean-values (str/lower-case (str ch)) 0))

(defn reduce-to-single-digit [n]
  (loop [num n]
    (if (< num 10)
      num
      (recur (reduce + (map #(Character/digit % 10) (str num)))))))

(defn reduce-for-linda-goodman [n]
  (loop [num n]
    (if (or (= num 11) (= num 22) (< num 10))
      num
      (recur (reduce + (map #(Character/digit % 10) (str num)))))))

(defn sum-name-part [part]
  (reduce + (map char-value part)))

(defn chaldean-parts [name-parts]
  (map sum-name-part name-parts))

(defn linda-goodman-parts [name-parts]
  (map (comp reduce-for-linda-goodman sum-name-part) name-parts))

(defn cheiro-parts [name-parts]
  (map (comp reduce-to-single-digit sum-name-part) name-parts))

(defn format-name [name]
  (->> (str/split name #"\s+")
       (map #(str/capitalize (str/trim %)))
       (str/join " ")))

(defn process-name [name-input]
  (let [name-parts (str/split (str/lower-case name-input) #"\s+")
        formatted (format-name name-input)
        chaldean (chaldean-parts name-parts)
        linda (linda-goodman-parts name-parts)
        cheiro (cheiro-parts name-parts)
        total-chaldean (reduce + chaldean)
        total-linda (reduce + linda)
        total-cheiro (reduce + cheiro)]
    (println (str "\nNumerology totals for: " formatted))
    (println (format "%-24s: %s & %d" "Chaldean Numerology" chaldean total-chaldean))
    (println (format "%-24s: %s & %d" "Linda Goodman Numerology" linda total-linda))
    (println (format "%-24s: %s & %d" "Cheiro Numerology" cheiro total-cheiro))))

(defn -main [& args]
  (cond
    (and (= (first args) "-f") (second args))
    (let [file-name (second args)]
      (try
        (let [lines (->> (slurp file-name) str/split-lines (remove str/blank?))]
          (doseq [line lines] (process-name line)))
        (catch java.io.FileNotFoundException _
          (println (str "Error: The file '" file-name "' was not found.")))))

    :else
    (do
      (print "Please enter your name: ") (flush)
      (let [input (str/lower-case (read-line))]
        (if (str/blank? input)
          (println "Name cannot be empty. Please try again.")
          (process-name input))))))
