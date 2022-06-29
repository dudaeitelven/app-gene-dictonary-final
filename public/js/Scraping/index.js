const puppeteer = require('puppeteer');
const url = "http://eggnog5.embl.de/#/app/guided_search";

// const searchGene = "dnak";
// const searchOrganism = "Aeromonas hydrophila";
// const searchTargetganism = "Escherichia coli";

const agrs = process.argv.slice(2);
// console.log(agrs);

const searchGene = agrs[0];
const searchOrganism = agrs[1];
const searchTargetganism = agrs[2];

// console.log(searchGene);
// console.log(searchOrganism);
// console.log(searchTargetganism);

async function start() 
{
    const browser = await puppeteer.launch({headless: true});
    const page = await browser.newPage();
    
    //console.log('Iniciei');

    await page.goto(url);

    await page.waitForSelector('#guided_search');
    await page.type('#guided_search', searchGene);

    await page.evaluate(() => {
        document.querySelectorAll('div.input-group > span > button')[2].click()
    });

    await page.waitForTimeout(3000); 
    await page.waitForSelector('div > span:nth-child(5) > span');

    //await page.waitForFunction("document.querySelector('.btnNext'));

    await page.evaluate(() => {
        document.querySelectorAll('div > span:nth-child(5) > span')[0].click()
    });

    await page.waitForSelector('div > span:nth-child(5) > div > div > h3 > form > input');
    await page.type('div > span:nth-child(5) > div > div > h3 > form > input', searchOrganism);

    await page.waitForTimeout(3000); 
    //await page.waitForSelector('div > span:nth-child(5) > div > div > div.species_menu > ul > li:nth-child(2) > a');

    await page.evaluate(() => {
        document.querySelector('div > span:nth-child(5) > div > div > div.species_menu > ul > li:nth-child(2) > a').click()
    });

    await page.waitForSelector('#guided_species_search');
    await page.type('#guided_species_search', searchTargetganism);

    await page.evaluate(() => {
        document.querySelectorAll('div.input-group > span > button')[3].click()
    });

    await page.evaluate(() => {
        document.querySelector('div > div:nth-child(4) > div.col-md-11 > a').click()
    });

    await page.waitForTimeout(3000); 
    //await page.waitForSelector('div > span:nth-child(5) > div > div > div.species_menu > ul > li:nth-child(2) > a');

    await page.evaluate(() => {
        document.querySelectorAll('div:nth-child(2) > button')[2].click()
    });
    
    await page.waitForTimeout(20000);

    const searchTargetGenes = await page.evaluate(() => {
        return Array.from(document.querySelectorAll('div:nth-child(2) > div:nth-child(5) > div.quickview > div > table > tbody > tr:nth-child(2) > td:nth-child(4) > span')).map(x => x.textContent)
    });

    await browser.close();

    //console.log('Terminei');

    return (searchTargetGenes.join());
}

start().then((value) => {
    console.log(value); // Success!
});