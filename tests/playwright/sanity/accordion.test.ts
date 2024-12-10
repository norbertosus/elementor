import { expect } from '@playwright/test';
import { parallelTest as test } from '../parallelTest';
import WpAdminPage from '../pages/wp-admin-page';

test( 'Accordion', async ( { page, apiRequests }, testInfo ) => {
	// Arrange.
	const wpAdmin = new WpAdminPage( page, testInfo, apiRequests ),
		editor = await wpAdmin.openNewPage();
	const preview = editor.getPreviewFrame();

	// Act.
	await editor.addWidget( 'accordion' );

	// Assert
	await editor.togglePreviewMode();
	expect( await preview
		.locator( '.elementor-widget-wrap > .elementor-background-overlay' )
		.screenshot( { type: 'jpeg', quality: 90 } ) )
		.toMatchSnapshot( 'accordion.jpeg' );
} );
