Feature: Basic redis call
  Using PECL adapter

  Scenario: basic redis call
    Given I use service "highco_redis.adapter" for adapter
    When I call "set" on adapter with arguments:
        | key       | value |
        | whoisgod  | chuck |
    Then I should have "output" equals to "true":
    When I call "get" on adapter with arguments:
        | key       |
        | whoisgod  |
    Then I should have "output" equals to "chuck":
    When I call "del" on adapter with arguments:
        | key       |
        | whoisgod  |
    Then I should have "output" equals to "1":
    When I call "get" on adapter with arguments:
        | key       |
        | whoisgod  |
    Then I should have "output" equals to "0":
