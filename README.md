codingforinterviews.com
=======================

Solutions to the weekly coding problems on codingforinterviews.com

Problems
========

Week 8 - 21-Feb-2013 - binary_search.php and singleton.php
--------------------

1. Write a simple singleton class in your favorite programming language with an example usage.
2. Solve the Sorted array binary search problem:

    Given a sorted array of integers array and an integer key, return the
    index of the first instance of key in the array. If key is not present in
    array, you should return -1.

    For example, given the array [-10, -2, 1, 5, 5, 8, 20] and key 5, you
    should return the index 3.

    Your solution should be a binary search, that is, it should run in O(log n) time.

Week 7 - 5-Feb-2013 - tower_of_hanoi_stacks.php
--------------------

Problem of the week - A Stack of Stack Problems

    1. Research stacks and write about one interesting use case for stacks.
    2. Write a data structure that provides the operations of the stack—push, pop, and peek
    3. Write a Towers of Hanoi solver, without using recursion.

In the Towers of Hanoi puzzle, you have three towers of rings—tower 1, tower
2, and tower 3.

Rings can only be placed on top of rings bigger than them. The goal is to
transfer the rings from tower 1 (with n rings) to tower 2 (empty) without
breaking the rule that smaller rings must always only be on top of bigger
rings.

Write a solver for Towers of Hanoi in your favorite programming language. You
can choose the form of your solution:

    1. Return a list of the operations that would be required to move from tower 1 to tower 2.
    2. Graphically show the steps of a solution to move from tower 1 to tower 2.


Week 6 - 22-Jan-2013 - trie.php
--------------------

For this week, complete these tasks:

    1. Research different variants of the trie and explain in your own words what to consider when implementing one
    2. Write an auto-completer.

An auto-completer? What does that mean? It's up to you! It could be as simple
as suggesting a few random word suffixes from the dictionary, or as involved
as supporting various spelling errors, integrating word frequency
information, or something evil like suggesting the worst possible yet still
technically correct suffix.


Week 5 - 13-Jan-2013 - binary_tree.php
--------------------

For this week, complete these tasks:

    1. Implement a simple binary (non-search) tree node data structure in your favorite programming language and write the following methods: (1) print nodes pre-order, (2) print nodes in-order, (3) print nodes post-order.
    2. Write a function that, given two nodes and a tree root, finds the two nodes' lowest common ancestor. That is, the function should find the ancestor that both nodes share that is furthest away from the root.
    3. Start out trying #2 allowing each node to have a pointer to its parent. Challenge: can you do it without parent pointers? What would the time and space complexities be for your implementations?


Week 4 - 3-Jan-2013 - linked_list.php
--------------------

Implement a simple singly-linked list data structure in your favorite language.

Then, implement all the following linked list interview questions:

    1. Write a function to remove a list's 3rd from last element. Challenge: can you do it in a single list traversal?
    2. Write a function to remove all duplicates from a linked list. Challenge: can you do it without storing any extra data?
    3. Write a function to detect a loop in a linked list.

Week 3 - 24-Dec-2012 - merge_sort.php
--------------------

Write a function that merges an array of already sorted arrays, producing one
large, still sorted array. For example, your input might be:

[[0, 5, 8, 9], [1, 2, 7], [10]]

And you should return:

[0, 1, 2, 5, 7, 8, 9, 10]


Week 2 - 17-Dec-2012 - check_binary_search_tree.php
--------------

Write a function that returns whether a given binary tree is a valid binary search tree. Use your favorite programming language. For extra credit, write your response on paper or your gigantic Mark Zuckerberg-approved whiteboard. You likely won't have an IDE at your next interview.


Week 1 - 10-Dec-2012 - hash_table.php
-----------

For this week, take a stab at implementing a hash table in your favorite programming language. That is to say, write a data structure that will let you map keys to values and give you amortized constant-time access. Your implementation should have some form of collision handling--what do you do when your hash function maps two keys to the same place?

This is a game of taboo—don't use any associative arrays (dictionaries, hash.*s, {}s, PHP array(k=>v)s etc) in your implementation. Time yourself, and time box your attempt to one hour. As Yegge notes: "You should be able to implement one using only arrays in your favorite language, in about the space of one interview."
