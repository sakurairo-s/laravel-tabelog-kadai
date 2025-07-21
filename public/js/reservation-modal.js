// 予約のキャンセル用フォーム
const cancelReservationForm = document.forms.cancelReservationForm;

// 削除の確認メッセージ
const cancelMessage = document.getElementById('cancelReservationModalLabel');

// 予約のキャンセル用モーダルを開くときの処理
document.getElementById('cancelReservationModal').addEventListener('show.bs.modal', (event) => {
    let cancelButton = event.relatedTarget;
    let reservationId = cancelButton.dataset.reservationId;
    let shopName = cancelButton.dataset.shopName;

    cancelReservationForm.action = `reservations/${reservationId}`;
    cancelMessage.textContent = `「${shopName}」の予約をキャンセルしてもよろしいですか？`
});