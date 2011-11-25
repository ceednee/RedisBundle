Feature: Persist an entity on redis
  Using PECL adapter

  Scenario: basic redis call
    Given I use service "highco_redis.entity_persister" for "persister" attribute
    And I use class "\Highco\Bundle\RedisBundle\Features\Stub\UserEntity" for "entity" attribute
    And I hydrate "entity" with values:
        | username | firstname | lastname |
        | god      | chuck     | norris
    When I persist entity with format "json"
    Then I should have "output" equals to "true"
