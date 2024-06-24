import { parallelTest as test } from '../parallelTest';
import { generatePluginTests } from './plugin-tester-generator';
import WpAdminPage from '../pages/wp-admin-page';

test.describe( `Plugin tester tests: containers`, () => {
	test.beforeAll( async ( { browser, apiRequests }, testInfo ) => {
		const page = await browser.newPage();
		const wpAdmin = new WpAdminPage( page, testInfo, apiRequests );
		await wpAdmin.resetExperiments();
		await wpAdmin.setExperiments( { container: 'active' } );

		await page.close();
	} );

	generatePluginTests( 'containers' );
} );
