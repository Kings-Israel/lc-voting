<x-modal-confirm
    livewire-event-to-open-modal='deleteCommentSet'
    event-to-close-modal='commentDeleted'
    modal-title='Delete Comment'
    modal-description='Are you sure you want to delete this comment? This action cannot be undone.'
    modal-confirm-button-text='Delete Comment'
    wire-click='deleteComment'
/>
