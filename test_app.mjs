import { chromium } from '@playwright/test';

const browser = await chromium.launch({ headless: true });
const page = await browser.newPage();
await page.setViewportSize({ width: 1400, height: 900 });
const shot = async (name) => { await page.screenshot({ path: `/tmp/${name}.png` }); console.log(`✓ ${name}`); };

await page.goto('http://qwankido.test/'); await page.waitForLoadState('networkidle'); await shot('p1_home');
await page.goto('http://qwankido.test/login'); await page.waitForLoadState('networkidle');
await page.fill('input[type="email"]', 'padu.costi7@gmail.com');
await page.fill('input[type="password"]', 'password');
await page.click('button[type="submit"]'); await page.waitForLoadState('networkidle'); await shot('p2_admin_dashboard');
await page.goto('http://qwankido.test/admin/curriculum'); await page.waitForLoadState('networkidle'); await shot('p3_curriculum');
await page.click('button:has-text("Editează")'); await page.waitForTimeout(500); await shot('p4_curriculum_edit');
await page.goto('http://qwankido.test/login'); await page.waitForLoadState('networkidle');
await page.fill('input[type="email"]', 'student@test.com');
await page.fill('input[type="password"]', 'password');
await page.click('button[type="submit"]'); await page.waitForLoadState('networkidle'); await shot('p5_student');

await browser.close(); console.log('Done!');
