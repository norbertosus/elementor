import * as React from 'react';
import { SvgIcon, SvgIconProps } from '@elementor/ui';

const ShrinkIcon = React.forwardRef( ( props: SvgIconProps, ref ) => {
	return (
		<SvgIcon viewBox="0 0 24 24" { ...props } ref={ ref }>
			<path fillRule="evenodd" clipRule="evenodd" d="M6.46967 15.5303C6.17678 15.2374 6.17678 14.7626 6.46967 14.4697L8.93934 12L6.46967 9.53033C6.17678 9.23744 6.17678 8.76256 6.46967 8.46967C6.76256 8.17678 7.23744 8.17678 7.53033 8.46967L10.5303 11.4697C10.8232 11.7626 10.8232 12.2374 10.5303 12.5303L7.53033 15.5303C7.23744 15.8232 6.76256 15.8232 6.46967 15.5303Z" />
			<path fillRule="evenodd" clipRule="evenodd" d="M17.5303 15.5303C17.2374 15.8232 16.7626 15.8232 16.4697 15.5303L13.4697 12.5303C13.1768 12.2374 13.1768 11.7626 13.4697 11.4697L16.4697 8.46967C16.7626 8.17678 17.2374 8.17678 17.5303 8.46967C17.8232 8.76256 17.8232 9.23744 17.5303 9.53033L15.0607 12L17.5303 14.4697C17.8232 14.7626 17.8232 15.2374 17.5303 15.5303Z" />
			<path fillRule="evenodd" clipRule="evenodd" d="M10.75 12C10.75 12.4142 10.4142 12.75 10 12.75L1 12.75C0.585787 12.75 0.25 12.4142 0.25 12C0.25 11.5858 0.585787 11.25 1 11.25L10 11.25C10.4142 11.25 10.75 11.5858 10.75 12Z" />
			<path fillRule="evenodd" clipRule="evenodd" d="M23.75 12C23.75 12.4142 23.4142 12.75 23 12.75H14C13.5858 12.75 13.25 12.4142 13.25 12C13.25 11.5858 13.5858 11.25 14 11.25H23C23.4142 11.25 23.75 11.5858 23.75 12Z" />
			<path fillRule="evenodd" clipRule="evenodd" d="M17.0303 9.21967C17.3232 9.51256 17.3232 9.98744 17.0303 10.2803L14.5607 12.75L17.0303 15.2197C17.3232 15.5126 17.3232 15.9874 17.0303 16.2803C16.7374 16.5732 16.2626 16.5732 15.9697 16.2803L12.9697 13.2803C12.6768 12.9874 12.6768 12.5126 12.9697 12.2197L15.9697 9.21967C16.2626 8.92678 16.7374 8.92678 17.0303 9.21967Z" />
			<path fillRule="evenodd" clipRule="evenodd" d="M5.96967 9.21967C6.26256 8.92678 6.73744 8.92678 7.03033 9.21967L10.0303 12.2197C10.3232 12.5126 10.3232 12.9874 10.0303 13.2803L7.03033 16.2803C6.73744 16.5732 6.26256 16.5732 5.96967 16.2803C5.67678 15.9874 5.67678 15.5126 5.96967 15.2197L8.43934 12.75L5.96967 10.2803C5.67678 9.98744 5.67678 9.51256 5.96967 9.21967Z" />
			<path fillRule="evenodd" clipRule="evenodd" d="M12.75 12.75C12.75 12.3358 13.0858 12 13.5 12H22.25C22.6642 12 23 12.3358 23 12.75C23 13.1642 22.6642 13.5 22.25 13.5H13.5C13.0858 13.5 12.75 13.1642 12.75 12.75Z" />
			<path fillRule="evenodd" clipRule="evenodd" d="M0 12.75C3.62117e-08 12.3358 0.335786 12 0.75 12L9.5 12C9.91421 12 10.25 12.3358 10.25 12.75C10.25 13.1642 9.91421 13.5 9.5 13.5L0.75 13.5C0.335786 13.5 -3.62117e-08 13.1642 0 12.75Z" />
		</SvgIcon>
	);
} );

export default ShrinkIcon;