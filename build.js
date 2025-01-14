const fs = require('fs-extra')
const archiver = require('archiver')
const path = require('path')

// Input data
const args = process.argv.slice(2)
if (args.length === 0) {
    console.error('❌ Please specify the version. Example: npm run build -- 1.0.0')
    process.exit(1)
}
const version = args[0]
const themeName = 'khpi-university-hub'
const outputDir = path.join(__dirname, `${themeName}`)
const distDir = path.join(__dirname, 'dist')

// Make sure the ./dist folder exists
fs.ensureDirSync(distDir)

// Excluded files and folders
const exclusions = ['node_modules', 'build.js', 'dist', 'package.json', 'package-lock.json', 'scss', '.git', '.gitignore', '.env', 'megamenu-themes', 'cse-guide', themeName]

// Cleaning the build folder
fs.removeSync(outputDir)
fs.ensureDirSync(outputDir)

// Copy files, excluding unnecessary ones
fs.readdirSync(__dirname).forEach((item) => {
    if (!exclusions.includes(item) && !item.startsWith('.')) {
        const sourcePath = path.join(__dirname, item)
        const destinationPath = path.join(outputDir, item)
        fs.copySync(sourcePath, destinationPath)
    }
})

// Create a zip archive in the dist folder
const outputZip = fs.createWriteStream(path.join(distDir, `${themeName}.${version}.zip`))
const archive = archiver('zip', { zlib: { level: 9 } })

outputZip.on('close', () => {
    console.log(`✅ Archive created: dist/${themeName}.${version}.zip (${archive.pointer()} bites)`)

    // Delete temporary folder after archiving is complete
    fs.removeSync(outputDir)
})

archive.on('error', (err) => {
    throw err
})

archive.pipe(outputZip)
archive.directory(outputDir, themeName)
archive.finalize()
