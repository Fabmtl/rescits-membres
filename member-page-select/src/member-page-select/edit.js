import { __ } from '@wordpress/i18n';
import { useState, useEffect } from "@wordpress/element";
import {
	SelectControl,
	Spinner,
	PanelBody,
	CheckboxControl,
} from "@wordpress/components";
import { useSelect } from "@wordpress/data";
import { InspectorControls } from "@wordpress/block-editor";

const Edit = ({ attributes, setAttributes }) => {
	const { parentPageId, selectedPages } = attributes;
	const [childPages, setChildPages] = useState([]);
	const [loading, setLoading] = useState(true);

	const currentPageTitle = useSelect((select) => {
		const currentPostId = select("core/editor").getCurrentPostId();
		const currentPost = select("core").getEntityRecord(
			"postType",
			"page",
			currentPostId,
		);
		return currentPost ? currentPost.title.rendered : "";
	}, []);
	// Récupérer toutes les pages via l'API REST de WordPress
	const pages = useSelect((select) => {
		return select("core").getEntityRecords("postType", "page", {
			per_page: -1,
		});
	}, []);

	useEffect(() => {
		if (!pages || !parentPageId) return;

		// Filtrer les pages enfants
		const children = pages.filter((page) => page.parent === parentPageId);
		setChildPages(children);
		setLoading(false);
	}, [pages, parentPageId]);

	const handleParentPageChange = (newParentPageId) => {
		const id = parseInt(newParentPageId, 10);
		setAttributes({ parentPageId: id, selectedPages: [] });
		setAttributes({ currentPageTitle });
	};

	const togglePageSelection = (page) => {
		const isSelected = selectedPages.some(
			(selected) => selected.id === page.id,
		);
		const updatedSelection = isSelected
			? selectedPages.filter((selected) => selected.id !== page.id)
			: [
					...selectedPages,
					{ id: page.id, title: page.title.rendered, link: page.link },
			  ];

		setAttributes({ selectedPages: updatedSelection });
	};

	return (
		<>
			<InspectorControls>
				<PanelBody title="Paramètres du Sélecteur de Pages">
					<SelectControl
						label="Page Parent"
						value={parentPageId || ""}
						options={[
							{ label: "Sélectionnez une page", value: "" },
							...(pages
								? pages.map((page) => ({
										label: page.title.rendered,
										value: page.id,
								  }))
								: []),
						]}
						onChange={handleParentPageChange}
					/>

					{loading && <Spinner />}

					{!loading && childPages.length > 0 && (
						<>
							<h4>Pages enfants :</h4>
							{childPages.map((page) => (
								<CheckboxControl
									key={page.id}
									label={page.title.rendered}
									checked={selectedPages.some(
										(selected) => selected.id === page.id,
									)}
									onChange={() => togglePageSelection(page)}
								/>
							))}
						</>
					)}
				</PanelBody>
			</InspectorControls>

			<div className="absolute-wrapper-select">
				<div className="wrapper-select">
					<div className="selected-option">
						<p>{currentPageTitle}</p>
						<svg
							className="svg-icon"
							width="19"
							height="11"
							viewBox="0 0 19 11"
							fill="none"
							xmlns="http://www.w3.org/2000/svg"
						>
							<path
								d="M10.0162 10.4019C9.73299 10.6852 9.26701 10.6852 8.98377 10.4019L0.212431 1.63057C-0.0708103 1.34733 -0.0708103 0.881353 0.212431 0.598112C0.495672 0.314871 0.96165 0.314871 1.24489 0.598112L9.5 8.85322L17.7551 0.598112C18.0384 0.314871 18.5043 0.314871 18.7876 0.598112C19.0708 0.881353 19.0708 1.34733 18.7876 1.63057L10.0162 10.4019Z"
								fill="black"
							/>
						</svg>
					</div>
					<div className="options-container">
						{selectedPages.length > 0 ? (
							
								selectedPages.map((page) => (
									<p key={page.id}>
										<a
											href={page.link}
											rel="noopener noreferrer"
										>
											{page.title}
										</a>
									</p>
								))
							
						) : (
							<p>{__("Aucune page sélectionnée.","rescits")}</p>
						)}
					
					</div>
				</div>
			</div>
		</>
	);
};

export default Edit;
