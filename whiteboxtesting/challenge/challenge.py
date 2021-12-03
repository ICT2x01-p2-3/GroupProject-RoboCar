class Challenge:
    
    def __init__(self, name, difficulty, solution, maze):
        self.name = name
        self.difficulty = difficulty
        self.solution = solution
        self.maze = maze

    def get_id(self, id):
        return self.id

    def get_name(self, name):
        return self.name

    def get_difficulty(self):
        return self.difficulty

    def get_solution(self):
        return self.solution

    def get_maze(self):
        return self.maze

    def set_id(self, id):
        self.id = id
        return True

    def set_difficulty(self, difficulty):
        self.difficulty = difficulty
        return True
    
    def set_solution(self, solution):
        self.solution = solution
        return True

    def set_maze(self, maze):
        self.maze = maze
        return True


    def testCase1():
        name1 = "Adam"
        difficulty1 = "Easy"
        solution1 = "forward forward forward"
        maze1 = "object1"
        cc = Challenge(name=name1,difficulty=difficulty1,solution=solution1,maze=maze1)
        cc2 = Challenge(name=1,difficulty=1,solution=1,maze=1)
        print("\nTest Case 1: Insert Object into Challenge Class\n")
        assert cc ,"Print Object Challenge"
        assert cc2,"Invalid Object"
        print(cc)
    def testCase2():
        name1 = "Adam"
        difficulty1 = "Easy"
        solution1 = "forward forward forward"
        maze1 = "object1"
        cc = Challenge(name=name1,difficulty=difficulty1,solution=solution1,maze=maze1)
        
        print("\nTest Case 2: Get ID of Object from Challenge Class\n")
        cc.set_id(1)
        assert cc.get_id(1), "Print ID of Object Challenge"
        return cc.get_id(1)
    def testCase3():
        name1 = "Adam"
        difficulty1 = "Easy"
        solution1 = "forward forward forward"
        maze1 = "object1"
        cc = Challenge(name=name1,difficulty=difficulty1,solution=solution1,maze=maze1)
        print("\nTest Case 3: Get Name of Object from Challenge Class\n")
        assert cc.get_name("Adam"), "Print Object Challenge"
        print(cc.get_name("Adam"))

    def testCase4():
        name1 = "Adam"
        difficulty1 = "Easy"
        solution1 = "forward forward forward"
        maze1 = "object1"
        cc = Challenge(name=name1,difficulty=difficulty1,solution=solution1,maze=maze1)
        
        print("\nTest Case 4: Get Difficulty of Object from Challenge Class\n")
        assert cc.get_difficulty(), "Print Object Challenge"
        print(cc.get_difficulty() )
    
    def testCase5():
        name1 = "Adam"
        difficulty1 = "Easy"
        solution1 = "forward forward forward"
        maze1 = "object1"
        cc = Challenge(name=name1,difficulty=difficulty1,solution=solution1,maze=maze1)
        print("\nTest Case 5: Get Solution of Object from Challenge Class\n")
        assert cc.get_solution(), "Print Object Challenge"
        print(cc.get_solution() )
    def testCase6():
        name1 = "Adam"
        difficulty1 = "Easy"
        solution1 = "forward forward forward"
        maze1 = "object1"
        cc = Challenge(name=name1,difficulty=difficulty1,solution=solution1,maze=maze1)
        
        print("\nTest Case 6: Get Maze Value of Object from Challenge Class\n")
        assert cc.get_maze(), "Print Maze Challenge"
        print(cc.get_maze() )
    def testCase7():
        name1 = "Adam"
        difficulty1 = "Easy"
        solution1 = "forward forward forward"
        maze1 = "object1"
        cc = Challenge(name=name1,difficulty=difficulty1,solution=solution1,maze=maze1)
        print("\nTest Case 7: Change Maze Value of Object from Challenge Class\n")
        assert cc.set_maze("object2"), "Print New Maze Challenge"
        print(cc.get_maze() )
    def testCase8():
        name1 = "Adam"
        difficulty1 = "Easy"
        solution1 = "forward forward forward"
        maze1 = "object1"
        cc = Challenge(name=name1,difficulty=difficulty1,solution=solution1,maze=maze1)
        print("\nTest Case 8: Change Difficulty Value of Object from Challenge Class\n")
        assert cc.set_difficulty("Medium"), "Print New Difficulty Challenge"
        print(cc.get_difficulty() )
    
    def testCase9():
        name1 = "Adam"
        difficulty1 = "Easy"
        solution1 = "forward forward forward"
        maze1 = "object1"
        cc = Challenge(name=name1,difficulty=difficulty1,solution=solution1,maze=maze1)
        print("\nTest Case 9: Change Solution Value of Object from Challenge Class\n")
        assert cc.set_solution("forward left left"), "Print New Solution Challenge"
        print(cc.get_solution() )
    def testCase10():
        name1 = "Adam"
        difficulty1 = "Easy"
        solution1 = "forward forward forward"
        maze1 = "object1"
        cc = Challenge(name=name1,difficulty=difficulty1,solution=solution1,maze=maze1)
        print("\nTest Case 10: Change Difficulty Value of Object from Challenge Class\n")
        assert cc.set_id(2), "Change New ID Object Challenge"
        print(cc.get_id(2) )
Challenge.testCase1()
Challenge.testCase2()
Challenge.testCase3()
Challenge.testCase4()
Challenge.testCase5()
Challenge.testCase6()
Challenge.testCase7()
Challenge.testCase8()
Challenge.testCase9()
Challenge.testCase10()