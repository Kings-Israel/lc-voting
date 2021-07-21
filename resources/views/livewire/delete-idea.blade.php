<x-modal-confirm
    event-to-open-modal='custom-show-delete-idea-modal'
    event-to-close-modal='ideaDeleted'
    modal-title='Delete Idea'
    modal-description='Are you sure you want to delete this idea? This action cannot be undone.'
    modal-confirm-button-text='Delete Idea'
    wire-click='deleteIdea'
/>
