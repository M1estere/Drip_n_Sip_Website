import data from './translations.json' assert { type: "json" }
console.log(data)

const translatables = JSON.parse(JSON.stringify(data))

export default translatables