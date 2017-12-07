require 'net/http'

uri = URI('http://www.your-url.com')

response = Net::HTTP.get(uri)


puts response

puts response.class