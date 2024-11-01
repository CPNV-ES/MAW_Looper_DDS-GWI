[Diagram direct access](https://www.plantuml.com/plantuml/uml/jLRVJzim47xtNt6FgTQYmlOqVeYkBLCbnj3AsCCs8JUvbWpNZco7qHN-zpbEN2vBMtKJGoYK-_7TT-Vlt9mQoxNDvuAPkrHcNFCvn88RqxDMfvFSuYXMSfp-GkWobl7uZiyGUbdsxODAK2mP0u0o0mRSyWatk6HG_NJWLXaBRy4uC3aZzapfjVPaSi7dkCwJ6zHoWozpvNygdJHzhy2WmDX6Zffupcr3h4G-byPPldvlmpGL5hM1O_UVCt6j-QA8oQLrjgupfTAsGKsd1kiMdQ1-jwWItQFbdwH-AXtnPlrxBd8qgvI9KW8UOVWGOsPJ9Gb0dYNSuZQ0WgbCqY9l9yG41JOHTmAX9zLNKc9ScACYzdBmqRkVg2REKXJ9aeuZAKVdK6Kk1F7K3hVfjelCkKl0A_Uv6O4FgEFKu6X3YGxKEoQEe8RWgftWqL6ifBFdiLNwvAIa4AqQEVPLsdN-mUffZ_uC9KofeqMApj3wEYRQ51o6uRWsqw9fyGmfhIgK1COQkSKojiQSKawQL5TbuT6heo6hPdd2cAGGRMzduG0eZM3PgK873DfhloaHtRYcK5UwsasiDhL4IVzDQO5KKsrr0ki5v3Ff75jqWVvXICFg55vaeOtbDZU1sYR_LT5d7UEG17aLcETLMCCYdqzGbxj42Xs--665uUnuCv3-gO8RArhV2w9mSj2Xj8bQuTjhVS2sooJ4a4mkBEgnv-cw2W4-yMzNZSgeH5pIL6yXt0dcvyntTQ_IfDvK2KDQBYizrTzJ-ahZabQlNbpeDvb322ylMmxO9qQXeU99KFjAMgs4GBqC7RjVdmATpZEy5wApF5PuRBMFr1X6JMrbkzH2mrIv0HN-tXwvF1XZKba4Rk1IgnyOMrRzTNsVAvMXPbVLTNAzVzCl-XcaVARv_APozt9xgxGfvfIgcO913yQZy-iUd0q_NVGk1iDn6zwZcawrMZX8UyirV1cT3qRCDLxWTbztzhkTW-x16uOoWO8FEtMVyhdu3G00)
Code for it (use it on [PlantUML website](http://www.plantuml.com/plantuml/uml/)
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
        + select(table : string, columns : [], filters = [] : array, count = 0 : int, offset = 0 : int, orderBy = [] : []) : []
        + insert(table : string, values : []) : bool | Exception
        + update(table : string, values : [], conditions : []) : bool | Exception
        + delete(table : string, conditions : []) : bool | Exception
        - dbConnection() : PDO
    }

    class Field{
        + id : int | null
        + name : string | null
        + type : FieldType | null
        + exerciseId : int | null
        - table : string
        - columns : string[]
        + <<constructor>> Field(id : int = null, name : string = null, typeId : int = null, exerciseId : int = null)
        + getFields(exerciseId : int = null) : Field[]
        + getField(fieldId : int): Field
        + createField(name : string, typeId : id, exerciseId : int) : Field | bool
        + deleteField(fieldId : int = null) : bool
        + updateField(name : string, typeId : int, exerciseId : int, fieldId : int = null) : bool
        - setValues(values : [])
    }

    class FieldType{
        + id : int | null
        + title : string | null
        - table : string
        - columns : string[]
        + <<constructor>> FieldType(id : int = null, title : string = null)
        + getType(typeId : int) : FieldType
        - setValues(values : [])
    }

    class Exercise{
        + id : int | null
        + name : string | null
        + statusId : int | null
        + statusTitle string | null;
        + fields : Field[] | null
        + numberFields int | null;
        - table : string
        - columns : string[]
        + <<constructor>> Exercise(id : int = null, name : string = null, statusId : int = null)
        + create(name : string) : bool
        + getExercises() : array
        + getExercise(exerciseId : int = null) : Exercise
        + alterStatus(idExercise: int) : bool
        - setValues(values : [])
    }


    class Status{
        - status : array
        - setUp() : void
        + getStatus() : array
    }
}

package App\Core{

    class Model{
        - db : Database
        + <<constructor>> Model()
    }
    
    class Controller{
    }

}

Model -- Database
Field --|> Model
FieldType --|> Model
Exercise --|> Model
Status --|> Model

Exercise --o Field
Field ..> FieldType


note as Project
Project : Looper
Title : V1_ClassDiagram_Looper
Authors : Diogo DA SILVA FERNANDES, Geoffroy Lothar WILDI
Date : 03-10-2024
end note
@enduml
```