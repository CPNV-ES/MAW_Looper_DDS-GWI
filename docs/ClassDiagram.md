[Diagram direct access](https://www.plantuml.com/plantuml/png/ZPB1RjD048Rl-nHpB2AMtC892Qac3YXI21L1vG2ecjYJPEbwnvgT1KBfkxDhrKf33aNoOVLv_i-_DNiP54LZvum9jzRtADX1up24IbNiEYhD6_Oh-vkWDAR7vXQt15NVVttFBRax0sOOXneLrnWe4IXWnq7X5OJayDk1z2p_a7Qzn8wEMGma_eJs6C9FblOnVGw173LwbZxh3lCJQDZ5peT4K0Jt4zXOfoG1NiENRmVQSFIQM9cGzJe1tcm27HDfITxiZuBFniDGmVf0SbhX1xf8uN5apUpW3yn-DTIhPJ-aOz-YqXFftDItDeUUDhRawDJu_uQyb2bxJqq6PtdgglvWxarwZfO_PKcRVbZzU1DoEYN6cs3knu6aL67dIEuUN4C4Yk8mR3mh0GQu4lvEZPhna8mBvfx4m2UhmtzTdzzCixYsk1NiRiRtLTGTIyWTB6yPwWfMyyLr1Mzd7vVLifwj9l2EqgA5zqcgEnJuF5_KSvDxP7FveZWlYulouYKOyYtaKiPSfcFit5y0)

Code for it (use it on [PlantUML website](https://www.plantuml.com/plantuml/uml/SyfFKj2rKt3CoKnELR1Io4ZDoSa70000):
```md
@startuml

skinparam classAttributeIconSize 0

package App\Model{
 
    class Database{
        - host : string
        - port : string
        - dbName : string
        - username : string
        - password : string
        + select(table : string, columns : array, filters = [] : array, count = 0 : int, offset = 0 : int, orderBy = [] : array) : array
        + insert(table : string, values : array) : bool | Exception
        + update(table : string, values : array, conditions : array) : bool | Exception
        + delete(table : string, conditions : array) : bool | Exception
        - dbConnection() : PDO
    }

}

package App\Core{

    class Model{
        - db : Database
    }
    
    class Controller{
    }

}

Model -- Database

note as Project
    Project : Looper
    Title : V1_ClassDiagram_Looper
    Authors : Diogo DA SILVA FERNANDES, Geoffroy Lothar WILDI
    Date : 03-10-2024 
end note

@enduml
```