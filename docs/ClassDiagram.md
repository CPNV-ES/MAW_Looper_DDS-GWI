[Diagram direct access](http://www.plantuml.com/plantuml/duml/lLTVRzis47_Nf-337cJCBjnkJqDRr8tJmK2M5OkNFMn3m4XdHwjC2YJLralotNSKTSufb5njo5eKYdL_xdvtzpkQVcETDAxUbOdzKAXA6haJMIcjNJXdYklQmIhJwgBu6yGyIIgPVP1R48kg-kCddKDvcoH2YE0XbjB9QsdXDX7jlvcuqTQ97uJ5O6hBv9KslVBy-bpke4zJMp1gG5TX-a_QvB7kMs6XXCob2Aryy9sAJ9VrJbcK_FxdL6oAqe6nuXM-eKWQ8_VUfbOEPNCK5SfDXTviB7Gb9WVpTjywucFIF5d-GY7mEFz7MTPW3oxNMfVYJfn-pg1oXLOiG5tbqi6n01wfoWllDoeY3WwYYEE3qAHEj5AGUN7gRTylVsxKzvmJxmeeyrlUZZoq3gEgkYoPfZFSMEts5Qf3m3L-ZYtWCvYiiB2AKX3cRiLCGMmWLMU2BrzYPr1UPqwRrwy3XFHGoAicoxIBdwGDxDKZKuwKAoOiwHPSayUcGyRK3CGQkwKR_oINIMlA33C3qa6mxI3daFCOwY6jk6lO4T4gJiyHamldzfTGACTXa6HKXfcmu2wRJKdvnlKGbNWrZgokS8n9_nlJ25JCjYw0VW8rdhoF4xv0_w59f-qKdcIXhPEkjgiXzp1W-y3oeGXeSH4-FCaKPk5C3o77ZOdQCl9CO9LpxaRBsTs8IR2Ermu7JG2E7XPa9Ex2zniB8Kj75MCDP4YKwT_ps73axk7peovoOXUZLq3mD0j8tA1Q1uSNaevVC5xThrNAoc43QODE63S9I6psTh_skPXrl7aBPJ-16TSQsTWUsRmrM4VEpKja4dQERCBRlr-l4TqFTKNTZseWUGITDBs8Uq_5_fGJ0elEnqQ6myAigSF75ONWlhG2t8Ck30IHkyHR_wXqPEBZcgTY4nVh8uRIZjyZQHL3Uhhw7WIqnZ45VUQnkxb3Mxchq629ETVuFdnTeoZiWFfwHEl7IifXYBtCyXtguvMNHzGW1rn_YigEr2-of0_tL7mpY9XmHEIuJ-wxF-nEj87Exxhsbnw_-cCm-hKttFFWcD8zmZzPr1EjdD5bIQSQei3_ZOkOpHx2D-H6oLqRBpbSOBYGokIoiCPS4aZ09Rub_9q7qc6nMWJFdh7xM98aIZiGqehtHly5cKlQlzYPCwqhCCcw_GAvV7vruYjU5d9hvEwgLIzgTwERlLiMUgl5SY4kLcUN2_7kz9VpnVdoz68gVWIzsHYznv3kHXhns-fikKhykD5j_jti-NpsOlxY-mHKBZoUv0r-gdVbFm00)
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
        + fields : Field[] | null
        + status : Status | null
        - table : string
        - columns : string[]
        - orderStatus : string[]
        + <<constructor>> Exercise(id : int = null, name : string = null, statusId : int = null)
        + create(name : string) : int | bool
        + getExercises(exerciseId : int = null) : Exercise | array
        + alterStatus(idExercise: int) : bool
        + delete(idExercise: int) : bool
        - setValues(values : []) : void
    }


    class Status{
        + id : int | null
        + title : string | null
        - status : array
        + <<constructor>> Status(id : int = null, title : string = null)
        - setUp() : void
        + getStatus() : Status | array
        + getStatusByTitle() : Status
    }

    class Answer{
        + id : int | null
        + answer : string | null
        + Test : int | Test | null
        + Field : int | Field | null
        - table : string
        - columns : array
        + <<constructor>> Answer(id : int = null, answer : string = null, Test : int | Test = null, Field : int | Field = null)
        + getAnswer(id : int = null) : array | Status | array
        + getByTest(test_id : int) : array | bool
        + getByField(idField : int) : array
        + create(answer : string, test : int | Test, field : int | Field) : Answer | Exception
        + update(values : array, filters : array) : bool
    }

    class Test{
        + id : int | null
        + timestamp : DateTime | null
        + exercise : int | Exercise | null
        - table : string
        - columns : array
        + <<constructor>> Answer(id : int = null, timestamp : DateTime = null, exercise : int | Exercise = null)
        + getTest(id : int = null) : Test | bool
        + getTestsByExercise(idExercise : int) : array
        + create(timestamp : DateTime, $exercise : int | Exercise) : Test | Exception
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
Answer --|> Model
Test --|> Model

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