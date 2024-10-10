[Diagram direct access](https://www.plantuml.com/plantuml/png/ZPB1RjD048Rl-nHpB2AMtC892Qac3YXI21L1vG2ecjYJPEbwnvgT1KBfkxDhrKf33aNoOVLv_i-_DNiP54LZvum9jzRtADX1up24IbNiEYhD6_Oh-vkWDAR7vXQt15NVVttFBRax0sOOXneLrnWe4IXWnq7X5OJayDk1z2p_a7Qzn8wEMGma_eJs6C9FblOnVGw173LwbZxh3lCJQDZ5peT4K0Jt4zXOfoG1NiENRmVQSFIQM9cGzJe1tcm27HDfITxiZuBFniDGmVf0SbhX1xf8uN5apUpW3yn-DTIhPJ-aOz-YqXFftDItDeUUDhRawDJu_uQyb2bxJqq6PtdgglvWxarwZfO_PKcRVbZzU1DoEYN6cs3knu6aL67dIEuUN4C4Yk8mR3mh0GQu4lvEZPhna8mBvfx4m2UhmtzTdzzCixYsk1NiRiRtLTGTIyWTB6yPwWfMyyLr1Mzd7vVLifwj9l2EqgA5zqcgEnJuF5_KSvDxP7FveZWlYulouYKOyYtaKiPSfcFit5y0)

Code for it (use it on [PlantUML website](www.plantuml.com/plantuml/png/fLNVJzim47xtNt6FgMXGONkQ0D6rPOh461g8FMmJSfDhoN3jo7OsEk1_tyM9MuUKgXDziDpFTzzzzyFngR5Sst8XcBdFPS4rNq0gk353QtK-BIqcgP9N-L-40MC5J-_v765O53y-gmp58mC60BKBZBdbKswGqEONmvqo5Zw08JOv3_12wOruDhtW2znqKXhKyfMpWiB_KJhhdks1GO6fZKYQMFls8LMYN4X3oFUVVPZbmg8sS4p_2E9QysLbKqfBs82WNDe-gDdCO1lH6UgFoyQHbfvRW_Yv9E7T-B-vAD6iNAPA2NY2oKEAXSsL30ZA8kCMjn5KIcMMLtuxCMOeiCkuCudlr4X9YMa5HvNjvVYBEtvch9w7inn5ziYe15bTBcAIfH24j1gvXkso8BXslARz-WGVKAUvmUG5LGpjB0ZmdVKGTMCFZeueE_fVfbRfavCwHBGITkpO-crT7dMoafUceQBWe4V1vcWTlubUC_99EctUF9fLgpVjDIPaa6ha5ckRbi9GMjQLj0e3JtKdcUzz4AyhpTaoFtZRmv9Z6DSZMvbZC6XltFX6uJLWuUJK0x1vUcnkWvQ_UHHyiEuuj0ErE-mymZhqmidT8Sb9KxN_kY76SbkQf6Fk2cxMO_NMedXnkrwHjgvsfJpNjjlWRRRMxRdz18sKfk853v1_au9l53dxPsc5TxDrZb6l_dovDM0TAMcr4W9rJLqBSIuGnsjwLtb2dXe-jXg64FI9XbW8ghg33Tl-VZ2VZ36fB08tSAdLBqnjfSVlATDpfGhK3hnk9lVcu7PKPJ7E-LppnMrWCYpjdTAcgb2kvWh6GxXApc-6S3RvUZ6y64-k-l09wSdJQadKzevh-9QSZnFdJMbN_8DtyS4WFXmSlWU6CeDA83kbNRaG_m00):
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
        - table : string
        - columns : string[]
        + <<constructor>> Exercise(id : int = null, name : string = null, statusId : int = null)
        + getExercise(exerciseId : int = null) : Exercise
        - setValues(values : [])
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