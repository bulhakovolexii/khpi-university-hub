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
const distDir = path.join(__dirname, 'dist')
const themeDir = path.join(__dirname, 'wp-content', 'themes', themeName)

// Make sure the ./dist folder exists
fs.ensureDirSync(distDir)

// Check if the theme directory exists
if (!fs.existsSync(themeDir)) {
    console.error(`❌ Theme directory not found: ${themeDir}`)
    process.exit(1)
}

// Create a zip archive in the dist folder
const outputZip = fs.createWriteStream(path.join(distDir, `${themeName}.${version}.zip`))
const archive = archiver('zip', { zlib: { level: 9 } })

outputZip.on('close', () => {
    console.log(`✅ Archive created: dist/${themeName}.${version}.zip (${archive.pointer()} bytes)`)
})

archive.on('error', (err) => {
    throw err
})

archive.pipe(outputZip)
archive.directory(themeDir, themeName)
archive.finalize()
